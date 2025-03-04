<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [''];

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'product_categories');
    // }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function singleProduct()
    {
        return $this->hasOne(ProductPrice::class);
    }

    public function variantProducts()
    {
        return $this->hasMany(ProductVariant::class)->with(['prices', 'variantValues']);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
