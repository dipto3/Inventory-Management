<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseReturn;
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
        // Validate incoming data
        $validated = $request->validate([
            'supplier_id'       => 'required|exists:suppliers,id',
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'purchase_id'       => 'required|exists:purchases,id',
            'return_date'       => 'required|date',
            'items'             => 'required|array',
        ]);

        // Create purchase return
        $purchaseReturn                    = new PurchaseReturn();
        $purchaseReturn->supplier_id       = $validated['supplier_id'];
        $purchaseReturn->purchase_order_id = $validated['purchase_order_id'];
        $purchaseReturn->purchase_id       = $validated['purchase_id'];
        $purchaseReturn->return_date       = $validated['return_date'];
        $purchaseReturn->save();

        // Loop through the items and create return entries
        foreach ($validated['items'] as $itemData) {
            $purchaseItem = PurchaseItem::findOrFail($itemData['purchase_item_id']);
            $returnItem   = $purchaseItem->replicate(); // Copy the purchase item details for return

            // Update the returned quantity
            $returnItem->return_quantity    = $itemData['return_quantity'];
            $returnItem->reason_id          = $itemData['reason_id'] ?? null;
            $returnItem->purchase_return_id = $purchaseReturn->id;

            // Save the return item
            $returnItem->save();

            // Optionally adjust inventory/quantity based on your requirements here
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
        return view('admin.purchase-return.index');
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
        //
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
