<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'                    => 'required',
            'discount_type'           => 'required',
            'discount_value'          => 'required',
            'minimum_order_amount'    => 'required',
            'maximum_discount_amount' => 'nullable',
            'start_date'              => 'required',
            'start_time'              => 'required',
            'end_date'                => 'required',
            'end_time'                => 'required',
            'usage_limit'             => 'nullable',
        ]);
        $coupon = Coupon::create([
            'code'                    => $request->code,
            'discount_type'           => $request->discount_type,
            'discount_value'          => $request->discount_value,
            'minimum_order_amount'    => $request->minimum_order_amount,
            'maximum_discount_amount' => $request->maximum_discount_amount,
            'start_date'              => Carbon::parse($request->start_date),
            'start_time'              => Carbon::parse($request->start_time),
            'end_date'                => Carbon::parse($request->end_date),
            'end_time'                => Carbon::parse($request->end_time),
            'usage_limit'             => $request->usage_limit,
            'status'                  => $request->status,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Coupon Added Successfully!',
            'coupon'  => $coupon,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupon.view-details', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return response()->json([
            'coupon' => $coupon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code'                    => 'required',
            'discount_type'           => 'required',
            'discount_value'          => 'required',
            'minimum_order_amount'    => 'required',
            'maximum_discount_amount' => 'nullable',
            'start_date'              => 'required',
            'start_time'              => 'required',
            'end_date'                => 'required',
            'end_time'                => 'required',
            'usage_limit'             => 'nullable',
        ]);
        $coupon_id = $request->coupon_id;
        $coupon    = Coupon::findOrFail($coupon_id);

        $coupon->update([
            'code'                    => $request->code,
            'discount_type'           => $request->discount_type,
            'discount_value'          => $request->discount_value,
            'minimum_order_amount'    => $request->minimum_order_amount,
            'maximum_discount_amount' => $request->maximum_discount_amount,
            'start_date'              => Carbon::parse($request->start_date),
            'start_time'              => Carbon::parse($request->start_time),
            'end_date'                => Carbon::parse($request->end_date),
            'end_time'                => Carbon::parse($request->end_time),
            'usage_limit'             => $request->usage_limit,
            'status'                  => $request->status,
        ]);
        return response()->json(['success' => true, 'message' => 'Coupon updated successfully', 'coupon' => $coupon]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(['success' => true]);
    }

    public function changeStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $status = $coupon->status == 0 ? 1 : 0;
        $coupon->update(['status' => $status]);
        if ($coupon) {
            if ($coupon->status == 1) {
                return response()->json(['success' => 'Coupon Status Is Active']);
            }
            if ($coupon->status == 0) {
                return response()->json(['success' => 'Coupon Status Is Inactive']);
            }
        } else {
            return response()->json(['error' => 'Coupon Status Is Failed To Update']);
        }
    }
}
