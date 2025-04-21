<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\ReturnReason;
use App\Models\Supplier;
use App\Models\SupplierCredit;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'supplier_id'       => 'required|exists:suppliers,id',
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'purchase_id'       => 'required|exists:purchases,id',
            'return_date'       => 'required|date',
            'total_amount'      => 'required|numeric|min:0',
            'items'             => 'required|array',
        ]);

        // Check return quantity validity before creating return
        foreach ($validated['items'] as $purchaseItemId => $itemData) {
            if (empty($itemData['quantity']) || $itemData['quantity'] <= 0) {
                continue;
            }

            $purchaseItem = PurchaseItem::findOrFail($purchaseItemId);

            // Total quantity returned before for this item
            $alreadyReturnedQty = PurchaseReturnItem::where('purchase_item_id', $purchaseItemId)->sum('quantity');

            // Available quantity to return
            $remainingQty = $purchaseItem->receive_quantity - $alreadyReturnedQty;

            // New return quantity user wants to return now
            $returnQty = $itemData['quantity'];

            if ($returnQty > $remainingQty) {
                toastr()->positionClass('toast-bottom-center')->addError('You have already returned some quantity of this product.Available quantity to return is ' . $remainingQty . '. Please adjust your return quantity.');
                return back()->withInput();
            }
        }

        // Create the purchase return
        $purchaseReturn                    = new PurchaseReturn();
        $purchaseReturn->supplier_id       = $validated['supplier_id'];
        $purchaseReturn->purchase_order_id = $validated['purchase_order_id'];
        $purchaseReturn->purchase_id       = $validated['purchase_id'];
        $purchaseReturn->return_date       = $validated['return_date'];
        $purchaseReturn->total_amount      = $validated['total_amount'];
        $purchaseReturn->save();

        // Save return items
        foreach ($validated['items'] as $purchaseItemId => $itemData) {
            if (empty($itemData['quantity']) || $itemData['quantity'] <= 0) {
                continue;
            }

            $purchaseItem = PurchaseItem::findOrFail($purchaseItemId);

            $returnItem                     = new PurchaseReturnItem();
            $returnItem->purchase_return_id = $purchaseReturn->id;
            $returnItem->purchase_item_id   = $purchaseItem->id;
            $returnItem->quantity           = $itemData['quantity'];
            $returnItem->unit_price         = $purchaseItem->purchase_price;
            $returnItem->return_reason_id   = $itemData['reason_id'] ?? null;
            $returnItem->save();
        }
        toastr()->positionClass('toast-bottom-center')->addError('Purchase Return Created Successfully');
        return redirect()->route('purchase-return.index');
    }

    public function getOrders($supplierId)
    {
        $orders = PurchaseOrder::where('supplier_id', $supplierId)->get();
        return response()->json($orders);
    }

    public function getPurchases($orderId)
    {
        $purchases = Purchase::where('purchase_order_id', $orderId)->get();
        return response()->json($purchases);
    }

    public function getItems($purchaseId)
    {
        $items = PurchaseItem::with('product')->where('purchase_id', $purchaseId)->get();
        return response()->json($items);
    }

    public function index()
    {
        $purchaseReturns = PurchaseReturn::with('supplier', 'purchaseOrder', 'purchase', 'purchaseReturnItems.purchaseItem.product', 'purchaseReturnItems.returnReason')->get();
        return view('admin.purchase-return.index', compact('purchaseReturns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers     = Supplier::all();
        $returnReasons = ReturnReason::where('status', 1)->get();
        return view('admin.purchase-return.create', compact('suppliers', 'returnReasons'));
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseReturn = PurchaseReturn::with('supplier', 'purchaseOrder', 'purchaseReturnItems', 'purchase', 'purchaseReturnItems.purchaseItem.product', 'purchaseReturnItems.purchaseItem.productVariant', 'purchaseReturnItems.returnReason', 'purchaseReturnItems.purchaseReturn')->findOrFail($id);

        return view('admin.purchase-return.view-details', compact('purchaseReturn'));
    }

    public function approvePurchaseReturn(string $id, Request $request)
    {
        $purchaseReturn = PurchaseReturn::findOrFail($id);
        $purchaseReturn->update([
            'is_approved' => $request->is_approved,
        ]);

        if ($request->is_approved == 1) {

            $totalReturnAmount = $purchaseReturn->total_amount;

            $purchase   = $purchaseReturn->purchase;
            $grandTotal = $purchase->grand_total;
            $paidAmount = $purchase->purchasePayments->sum('amount');

            if ($paidAmount < $grandTotal) {
                $newDue = $grandTotal - $totalReturnAmount;

                $purchase->grand_total = $newDue;
                $purchase->save();
            } else {
                $supplier       = $purchaseReturn->supplier;
                $existingCredit = SupplierCredit::where('supplier_id', $supplier->id)
                // ->where('purchase_id', $purchase->id)
                // ->where('purchase_return_id', $purchaseReturn->id)
                    ->first();
                if ($existingCredit) {
                    $existingCredit->update([
                        'credit_amount' => $existingCredit->credit_amount + $totalReturnAmount,
                    ]);
                } else {
                    SupplierCredit::create([
                        'supplier_id'        => $supplier->id,
                        'credit_amount'      => $totalReturnAmount,
                        'purchase_id'        => $purchase->id,
                        'purchase_return_id' => $purchaseReturn->id,
                    ]);
                }
            }
        }
        toastr()->positionClass('toast-bottom-center')->addSuccess('Purchase Return Approved Successfully');
        return redirect()->route('purchase-return.index');

    }

    public function getSupplierCredit($id)
    {
        $credits = SupplierCredit::where('supplier_id', $id)
            ->where('usage_type', 'next_order')
            ->where('credit_amount', '>', 0)
            ->get();
        return response()->json($credits);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
