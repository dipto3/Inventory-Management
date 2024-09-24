<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded =[''];

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'product_categories');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
}
