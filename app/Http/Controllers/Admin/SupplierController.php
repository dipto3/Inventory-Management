<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers',
            'email' => 'required|unique:suppliers',
            'address' => 'required',
            'city' => 'required',
        ]);
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('supplier_image', 'public');
        }
        $supplier = Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'status' => $request->status ?? 0,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Supplier Added Successfully!',
            'supplier' => $supplier
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
            'phone' => 'required|unique:suppliers',
            'email' => 'required|unique:suppliers',
            'status' => 'required',
            'address' => 'nullable',
            'city' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $supplier_id = $request->supplier_id;
        $supplier = Supplier::findOrFail($supplier_id);

        if ($request->hasFile('image')) {

            if ($supplier->image) {
                Storage::disk('public')->delete($supplier->image);
            }


            $imagePath = $request->file('image')->store('supplier_image', 'public');
            $validatedData['image'] = $imagePath;
        }

        $supplier->update($validatedData);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->image) {
            Storage::disk('public')->delete($supplier->image);
        }
        $supplier->delete();
        return response()->json(['success' => true]);
    }
}
