<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariantFormRequest;
use App\Models\Variant;
use App\Models\VariantValue;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = Variant::with('variantValues')->get();
        return view('admin.variant.index', compact('variants'));
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
    public function store(VariantFormRequest $request)
    {
        $request->validated();
        $variant = Variant::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        $valuesArray = array_map('trim', explode(',', $request->input('values')));

        foreach ($valuesArray as $value) {
            if (!empty($value)) {
                VariantValue::create([
                    'variant_id' => $variant->id,
                    'value' => $value,
                ]);
            }
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
    public function edit($id)
    {
        $variant = Variant::with('variantValues')->findOrFail($id);
        return response()->json(['variant' => $variant]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $variant_id = $request->variant_id;
        $variant = Variant::findOrFail($variant_id);
        $variant->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
    
        $valuesArray = array_map('trim', explode(',', $request->input('values')));
       
        $variant->variantValues()->delete();
    
        foreach ($valuesArray as $value) {
            if (!empty($value)) {
                VariantValue::create([
                    'variant_id' => $variant->id,
                    'value' => $value,
                ]);
            }
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {
        $variant->delete();
        return redirect()->back();
    }
}
