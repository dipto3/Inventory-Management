<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitFormRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return view('admin.unit.index', compact('units'));
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
    public function store(UnitFormRequest $request)
    {
        $request->validated();

        $unit = Unit::create([
            'name'       => $request->name,
            'status'     => $request->status,
            'short_name' => $request->short_name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Unit Added Successfully!',
            'unit'    => $unit,
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
    public function edit(Unit $unit)
    {
        return response()->json([
            'unit' => $unit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'       => 'required',
            'status'     => 'required',
            'short_name' => 'required',
        ]);
        $unit_id = $request->unit_id;
        $unit    = Unit::findOrFail($unit_id);

        $unit->update([
            'name'       => $validatedData['name'],
            'short_name' => $validatedData['short_name'],
            'status'     => $validatedData['status'],
        ]);
        return response()->json(['success' => true, 'message' => 'Unit updated successfully', 'unit' => $unit]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return response()->json(['success' => true]);
    }

    public function changeStatus(Request $request)
    {
        $unit   = Unit::findOrFail($request->id);
        $status = $unit->status == 0 ? 1 : 0;
        $unit->update(['status' => $status]);
        if ($unit) {
            if ($unit->status == 1) {
                return response()->json(['success' => 'Unit Status Is Active']);
            }
            if ($unit->status == 0) {
                return response()->json(['success' => 'Unit Status Is Inactive']);
            }
        } else {
            return response()->json(['error' => 'Unit Status Is Failed To Update']);
        }
    }
}
