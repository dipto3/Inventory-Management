<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    public function storePayment(Request $request)
    {
        // dd($request->all());
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

        return redirect()->back()->with('success', 'Payment created successfully');
    }
}
