<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategories = Category::with('parentCategory', 'childrenCategories.categories')->get();
        // dd($allCategories);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories.childrenCategories.childrenCategories')
            ->get();
        return view('admin.category.index', compact('categories', 'allCategories'));
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
    public function store(CategoryRequest $request)
    {
        // dd( $request->all());
        $request->validated();

        $category = Category::create([
            'name'        => $request->name,
            'parent_id'   => $request->parent_id,
            'status'      => $request->status,
            'description' => $request->description,
        ]);
        $slug           = strtolower(str_replace(' ', '_', $request->name)) . '_' . $category->id;
        $category->slug = $slug;
        $category->save();

        return response()->json([
            'success'  => true,
            'message'  => 'Category Added Successfully!',
            'category' => $category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // $category = Category::where('id', $id)->first();
        // $categories = Category::where('parent_id', 0)
        //     ->with('childrenCategories')
        //     ->orderBy('name', 'asc')
        //     ->get();
        // return response()->json($category, $categories);
        $categories = Category::where('id', '!=', $category->id)->get();
        $html       = view('admin.category.edit_form', compact('category', 'categories'))->render();

        return response()->json([
            'html'     => $html,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json([
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'parent_id'   => 'required|integer',
            'status'      => 'required|boolean',
        ]);
        $category_id = $request->category_id;
        $category    = Category::findOrFail($category_id);

        $category->name        = $validatedData['name'];
        $category->parent_id   = $validatedData['parent_id'];
        $category->description = $validatedData['description'];
        $category->status      = $validatedData['status'];
        $category->save();
        return response()->json(['success' => true, 'message' => 'Category updated successfully', 'category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['success' => true]);
    }

    public function updateOrdering(Request $request)
    {
        $category           = Category::findOrFail($request->category_id);
        $category->ordering = $request->ordering;
        $category->save();

        return response()->json(['success' => true]);
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $status   = $category->status == 0 ? 1 : 0;
        $category->update(['status' => $status]);
        if ($category) {
            if ($category->status == 1) {
                return response()->json(['success' => 'category Status Is Active']);
            }
            if ($category->status == 0) {
                return response()->json(['success' => 'category Status Is Inactive']);
            }
        } else {
            return response()->json(['error' => 'category Status Is Failed To Update']);
        }
    }
}
