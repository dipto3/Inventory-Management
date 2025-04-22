<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
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
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link'  => 'nullable',
        ]);
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banner_image', 'public');
        }
        $banner = Banner::create([
            'title'  => $request->title,
            'status' => $request->status,
            'link'   => $request->link,
            'image'  => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Banner Added Successfully!',
            'banner'  => $banner,
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
        $banner    = Banner::findOrFail($id);
        $image_url = asset('storage/' . $banner->image);

        return response()->json([
            'banner'    => $banner,
            'image_url' => $image_url,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner_id     = $request->banner_id;
        $validatedData = $request->validate([
            'title'  => 'required',
            'status' => 'required',
            'link'   => 'nullable',

        ]);

        $banner = Banner::findOrFail($banner_id);

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $imagePath              = $request->file('image')->store('banner_image', 'public');
            $validatedData['image'] = $imagePath;
        }

        $banner->update($validatedData);

        return response()->json(['success' => true, 'message' => 'Banner updated successfully', 'banner' => $banner]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();
        return response()->json(['success' => true]);
    }
}
