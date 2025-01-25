<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->with('categories')
            ->orderBy('ordering', 'asc');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
