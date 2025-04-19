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
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming data

        // Validate incoming data
        $validated = $request->validate([
            'supplier_id'        => 'required|exists:suppliers,id',
            'purchase_order_id'  => 'required|exists:purchase_orders,id',
            'purchase_id'        => 'required|exists:purchases,id',
            'return_date'        => 'required|date',
            'items'              => 'required|array',
            'total_amount'       => 'required',
            // 'per_product_discount' => 'required',
        ]);

        // Create purchase return
        $purchaseReturn                     = new PurchaseReturn();
        $purchaseReturn->supplier_id        = $validated['supplier_id'];
        $purchaseReturn->purchase_order_id  = $validated['purchase_order_id'];
        $purchaseReturn->purchase_id        = $validated['purchase_id'];
        $purchaseReturn->return_date        = $validated['return_date'];
        $purchaseReturn->total_amount       = $validated['total_amount'];
        // $purchaseReturn->per_product_discount = $validated['per_product_discount'];
        $purchaseReturn->save();

        // Loop through the items and create return entries
        foreach ($validated['items'] as $purchaseItemId => $itemData) {
            // dd($itemData);
            if (empty($itemData['quantity'])) {
                continue;
            }
            $purchaseItem = PurchaseItem::findOrFail($purchaseItemId);
// dd($purchaseItem);
            // Directly create a new purchase return item
            $returnItem = new PurchaseReturnItem();                           // Correct class name
                                                                              // $returnItem->product_id         = $purchaseItem->product_id;      // Assuming you want to copy the product
            $returnItem->quantity           = $itemData['quantity'];          // Set the return quantity
            $returnItem->unit_price         = $purchaseItem->purchase_price;  // Assuming you want to copy the price
            $returnItem->return_reason_id   = $itemData['reason_id'] ?? null; // Optionally set reason_id
            $returnItem->purchase_return_id = $purchaseReturn->id;
            $returnItem->purchase_item_id   = $purchaseItem->id; // Link to the return

            // Save the return item
            $returnItem->save();

        }
        return redirect()->route('purchase-return.index')->with('success', 'Purchase Return Created Successfully');

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
