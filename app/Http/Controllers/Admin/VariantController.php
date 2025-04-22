<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariantFormRequest;
use App\Models\Variant;
use App\Models\VariantValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getValues(Variant $variant)
    {
        return response()->json($variant->variantValues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VariantFormRequest $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $variant = Variant::create([
                    'name'   => $request->name,
                    'status' => $request->status,
                ]);

                $valuesArray = array_map('trim', explode(',', $request->input('values')));

                foreach ($valuesArray as $value) {
                    if (! empty($value)) {
                        VariantValue::create([
                            'variant_id' => $variant->id,
                            'value'      => $value,
                        ]);
                    }
                }
            });
            return response()->json([
                'success' => true,
                'message' => 'Variant created successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
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
        $variant      = Variant::with('variantValues')->findOrFail($id);
        $valuesString = $variant->variantValues->pluck('value')->implode(',');
        return response()->json(['variant' => $variant, 'values' => $valuesString]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $variant_id = $request->variant_id;
        $variant    = Variant::findOrFail($variant_id);
        $variant->update([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        $valuesArray = array_map('trim', explode(',', $request->input('values')));

        $variant->variantValues()->delete();

        foreach ($valuesArray as $value) {
            if (! empty($value)) {
                VariantValue::create([
                    'variant_id' => $variant->id,
                    'value'      => $value,
                ]);
            }
        }
        return response()->json(['success' => true, 'message' => 'variant updated successfully', 'variant' => $variant]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {

        $variant->delete();
        return response()->json(['success' => true]);
    }

    public function changeStatus(Request $request)
    {
        $variant = Variant::findOrFail($request->id);
        $status  = $variant->status == 0 ? 1 : 0;
        $variant->update(['status' => $status]);
        if ($variant) {
            if ($variant->status == 1) {
                return response()->json(['success' => 'variant Status Is Active']);
            }
            if ($variant->status == 0) {
                return response()->json(['success' => 'variant Status Is Inactive']);
            }
        } else {
            return response()->json(['error' => 'variant Status Is Failed To Update']);
        }
    }
}
