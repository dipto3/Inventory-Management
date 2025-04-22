<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
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
        // dd($request->all());
        // $request->validated();
        $imagePath = null;

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('brand_logo', 'public');
        }
        $brand = Brand::create([
            'name'        => $request->name,
            'status'      => $request->status,
            'description' => $request->description,
            'logo'        => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Brand Added Successfully!',
            'brand'   => $brand,
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
        $brand     = Brand::findOrFail($id);
        $image_url = asset('storage/' . $brand->logo);

        return response()->json([
            'brand'     => $brand,
            'image_url' => $image_url,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $brand_id      = $request->brand_id;
        $validatedData = $request->validate([
            'name'        => 'required',
            'status'      => 'required',
            'description' => 'required',

        ]);

        $brand = Brand::findOrFail($brand_id);

        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->image);
            }

            $imagePath             = $request->file('logo')->store('brand_logo', 'public');
            $validatedData['logo'] = $imagePath;
        }

        $brand->update($validatedData);

        return response()->json(['success' => true, 'message' => 'Brand updated successfully', 'brand' => $brand]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }
        $brand->delete();
        return response()->json(['success' => true]);
    }

    public function changeStatus(Request $request)
    {
        $brand  = Brand::findOrFail($request->id);
        $status = $brand->status == 0 ? 1 : 0;
        $brand->update(['status' => $status]);
        if ($brand) {
            if ($brand->status == 1) {
                return response()->json(['success' => 'brand Status Is Active']);
            }
            if ($brand->status == 0) {
                return response()->json(['success' => 'brand Status Is Inactive']);
            }
        } else {
            return response()->json(['error' => 'brand Status Is Failed To Update']);
        }
    }
}
