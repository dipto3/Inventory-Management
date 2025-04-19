<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with('purchaseOrder', 'purchasePayments',  'purchaseOrder.purchaseOrderItems')->orderBy('id', 'desc')->get();
        // dd($purchases);
        return view('admin.grn.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createGrn($id,Request $request)
    {
       
        $purchaseOrder = PurchaseOrder::with('purchaseOrderItems', 'supplier', 'user', 'purchaseOrderItems.product', 'purchaseOrderItems.productVariant')->find($id);
        // dd($purchaseOrder);
        return view('admin.grn.create', compact('purchaseOrder'));
    }

    public function storeGrn(Request $request, $id)
    {
        // dd($request->all());
        // // dd($id);
        
        // dd($validateData);
        try {
            DB::beginTransaction();
            // if quantity is 0 then not add in purchase
            $totalReceiveQuantity = 0;
            $validItems  = [];
            foreach ($request->items as $item) {
                if ($item['receive_quantity'] > 0) {
                    $validItems[] = $item;
                    $totalReceiveQuantity += $item['receive_quantity'];
                }
            }
            if (empty($validItems)) {
                return redirect()->back()->with('error', 'Please select at least one item');
            }
            $purchase = Purchase::create([
                'purchase_order_id' => $id,
                'purchase_code' => 'PR-' . date('Ymd') . '-' . str_pad(Purchase::count() + 1, 3, '0', STR_PAD_LEFT),
                'receive_date' => $request->receive_date,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'tax' => $request->tax,
                'total_receive_quantity' => $request->total_quantity,
                'grand_total' => $request->total_price,
                'total_tax' => $request->total_tax,
                'total_discount' => $request->total_discount,
                'product_subtotal' => $request->product_subtotal,
                'note' => $request->note,
                'total_shipping_cost' => $request->shipping_cost,
                'payment_status' => 'pending',
                'user_id' => auth()->user()->id,
            ]);
            if ($request->has('items')) {
                foreach ($request->items as $item) {
                    // if quantity is 0 then not add in purchase items
                    if ($item['receive_quantity'] <= 0) {
                        continue;
                    }
                    $findProduct = ProductVariant::find($item['product_variant_id']);
                    $findProduct->update([
                        'quantity' => $findProduct->quantity + $item['receive_quantity'],
                    ]);
                    $purchaseOrderItem = PurchaseOrderItem::where('product_variant_id', $item['product_variant_id'])->first();

                    if ($purchaseOrderItem) {
                        $purchaseOrderItem->update([
                            'received_quantity' => $purchaseOrderItem->received_quantity + $item['receive_quantity'],
                        ]);
                    }
                    $purchase->purchaseItems()->create([
                        'product_id' =>  $findProduct->product_id,
                        'product_variant_id' => $item['product_variant_id'],
                        'receive_quantity' => $item['receive_quantity'],
                        'purchase_price' => $item['purchase_price'],
                        'subtotal' => $item['product_subtotal'],
                    ]);
                }
            }
            $purchaseOrder = PurchaseOrder::find($id);
            if ($purchaseOrder) {
                $totalReceived = Purchase::where('purchase_order_id', $id)->sum('total_receive_quantity');

                $purchaseOrder->update([
                    'purchase_status'  => ($totalReceived == $purchaseOrder->total_quantity) ? 'completed' : 'partial',
                ]);
            }
            DB::commit();
            return redirect()->route('purchase.index')->with('success', 'Purchase created successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

    }

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
