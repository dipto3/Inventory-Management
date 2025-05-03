<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;

class HomeController extends Controller
{
    public function home()
    {
        $banners = Banner::where('status', 1)->get();
// dd($banners);
        $categories = Category::with('categories', 'childrenCategories.childrenCategories', 'parentCategory', 'childrenCategories.categories')->where('parent_id', 0)->where('status', 1)->orderBy('ordering')->get();

        return view('frontend.home.home', compact('banners', 'categories'));
    }
}
