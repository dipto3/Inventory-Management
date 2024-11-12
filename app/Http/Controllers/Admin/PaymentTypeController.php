<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentTypeController extends Controller
{
    public function index(){
        $paymentTypes = PaymentType::all();
        return view('admin.payment_type.index',compact('paymentTypes'));
    }

    public function create(){
        return view('admin.payment_type.create');
    }

    public function store(Request $request){
        $request->validate([
            'type' => 'required|unique:payment_types,type',
            'status' => 'required|in:1,0',
            'has_transaction' => 'required|in:1,0',
        ]);

        PaymentType::create($request->all());
        return redirect()->route('payment_type.index');
    }
    public function show(string $id)
    {
        $paymentTypes = PaymentType::where('id',$id)->first();
		return response()->json($paymentTypes);
    }

    public function edit(PaymentType $paymentType)
    {
        return response()->json([
            'paymentType' => $paymentType
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'type' => 'required|unique:payment_types,type,'.$id,
            'status' => 'required|in:1,0',
            'has_transaction' => 'required|in:1,0',
        ]);
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->update($request->all());
        return redirect()->route('admin.payment_type.index');
    }

    public function destroy(PaymentType $paymentTypes){
        $category->delete();
        return redirect()->back()->with('error', 'Payment Type Deleted successfully.');
    }
}
