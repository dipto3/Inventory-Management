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
        $suppliers = Supplier::orderBy('id', 'desc')->get();
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
            'address' => 'nullable',
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
    public function edit($id)
{
    $supplier = Supplier::findOrFail($id);
    $image_url = asset('storage/' . $supplier->image);
    
    return response()->json([
        'supplier' => $supplier,
        'image_url' => $image_url
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier_id = $request->supplier_id;
        
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone,' . $supplier_id, // Ignore current supplier's phone
            'email' => 'required|unique:suppliers,email,' . $supplier_id, // Ignore current supplier's email
            'status' => 'required',
            'address' => 'nullable',
            'city' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $supplier = Supplier::findOrFail($supplier_id);
    
        if ($request->hasFile('image')) {
            if ($supplier->image) {
                Storage::disk('public')->delete($supplier->image);
            }
            
            $imagePath = $request->file('image')->store('supplier_image', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        $supplier->update($validatedData);
        
        return response()->json(['success' => true, 'message' => 'Supplier updated successfully', 'supplier' => $supplier]);
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
