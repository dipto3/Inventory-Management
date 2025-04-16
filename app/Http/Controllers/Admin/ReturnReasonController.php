<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReturnReason;
use Illuminate\Http\Request;

class ReturnReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reasons = ReturnReason::all();
        return view('admin.return-reason.index', compact('reasons'));
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
        $returnReason = ReturnReason::create([
            'reason'      => $request->reason,
            'status'      => $request->status ?? 0,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Return Reason Added Successfully!',
            'unit'    => $returnReason,
        ]);
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
    public function edit(ReturnReason $returnReason)
    {
        return response()->json([
            'return_reason' => $returnReason,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'reason'      => 'required',
            'status'      => 'required',
            'description' => 'required',
        ]);
        $return_reason_id = $request->return_reason_id;
        $reason           = ReturnReason::findOrFail($return_reason_id);

        $reason->update([
            'reason'      => $validatedData['reason'],
            'description' => $validatedData['description'],
            'status'      => $validatedData['status'],
        ]);
        return response()->json(['success' => true, 'message' => 'Return Reason updated successfully', 'return_reason' => $reason]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnReason $returnReason)
    {
        $returnReason->delete();
        return response()->json(['success' => true]);
    }
}
