<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryFormRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status',1)->get();
        $subcategories = Subcategory::with('category')->get();
        return view('admin.subcategory.index',compact('categories','subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryFormRequest $request)
    {
        $request->validated();

        Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Subcategory created successfully.');
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
    public function edit(Subcategory $subcategory)
    {
        return response()->json([
            'subcategory' => $subcategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'status' => 'required|boolean'
        ]);
        $subcategory_id = $request->subcategory_id;
        $subcategory = Subcategory::findOrFail($subcategory_id);
        $subcategory->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'category_id' => $validatedData['category_id']
        ]);
        return redirect()->route('subcategory.index')->with('success', 'Subcategory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->back()->with('error', 'Subcategory Deleted successfully.');
    }
}
