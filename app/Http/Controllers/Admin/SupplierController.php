<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier = Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'status' => $request->status ?? 0,
        ]);
        if ($request->hasFile('image')) {
            $supplier->addMediaFromRequest('image')->toMediaCollection();
        }
        return redirect()->back();
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
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'status' => 'required',
            'address' => 'nullable',
            'city' => 'nullable',
        ]);
        $supplier_id = $request->supplier_id;
        $supplier = Supplier::findOrFail($supplier_id);
        $supplier->update([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'status' => $validatedData['status'],

        ]);
        if ($request->hasFile('image')) {
            $supplier->clearMediaCollection();
            $supplier->addMediaFromRequest('image')->toMediaCollection();
        }
        return redirect()->route('supplier.index')->with('success', 'Supplier Information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->clearMediaCollection();
        $supplier->delete();
        return redirect()->back();
    }
}
