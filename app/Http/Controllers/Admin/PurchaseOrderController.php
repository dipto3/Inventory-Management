<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = PurchaseOrder::orderBy('id', 'desc')->get();
        // dd($purchases);

        return view('admin.purchase-order.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('status', 1)->select('id', 'name')->get();
        // dd($suppliers);
        $productVariants = ProductVariant::with('product', 'prices')->get();
        // dd($products);
        return view('admin.purchase-order.create', compact('suppliers', 'productVariants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(auth()->user()->id);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $purchaseOrderCode = 'PRO-' . date('Ymd') . '-' . str_pad(PurchaseOrder::count() + 1, 4, '0', STR_PAD_LEFT);
            $purchaseOrder = PurchaseOrder::create([
                'supplier_id' => $request->supplier,
                'purchase_date' => $request->purchase_date,
                'purchase_order_code' => $purchaseOrderCode,
                'total_quantity' => $request->total_quantity,
                'total_price' => $request->total_price,
                'purchase_status' => 'pending',
                'user_id' => auth()->user()->id,
            ]);

            if ($request->has('products')) {
                foreach ($request->products as $variantId => $product) {
                    // dd($variantId);
                    $findProduct = ProductVariant::find($variantId);
                    $purchaseOrder->purchaseOrderItems()->create([
                        'product_id' => $findProduct->product_id,
                        'product_variant_id' => $variantId,
                        'purchase_quantity' => $product['quantity'],
                        'purchase_price' => $product['purchase_price'],
                        'subtotal' => $product['subtotal'],
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('purchase-order.index')->with('success', 'Purchase order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseOrder = PurchaseOrder::with('purchaseOrderItems', 'supplier', 'user', 'purchaseOrderItems.product', 'purchaseOrderItems.productVariant')->find($id);

        return view('admin.purchase-order.order-details', compact('purchaseOrder'));
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
