<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasePaymentController extends Controller
{
    public function storePayment(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $purchasePayment = PurchasePayment::create([
                'user_id' => auth()->user()->id,
                'purchase_id' => $request->purchase_id,
                'payment_method' => $request->payment_method,
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'account_number_from' => $request->account_number_from,
                'account_number_to' => $request->account_number_to,
                'note' => $request->note,
            ]);
            $purchase = Purchase::find($request->purchase_id);
            if ($purchase) {
                $totalReceived = PurchasePayment::where('purchase_id', $request->purchase_id)->sum('amount');
                $purchase->update([
                    'payment_status'  => ($totalReceived >= $purchase->grand_total) ? 'completed' : 'partial',
                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function viewPayment(Request $request, $id)
    {
        $purchase = Purchase::with('purchasePayments', 'purchaseOrder.supplier', 'purchaseItems.product', 'purchaseItems.productVariant')->find($id);
        // dd($purchase);
        return view('admin.grn.view', compact('purchase'));
    }
}
