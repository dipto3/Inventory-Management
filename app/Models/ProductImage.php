<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
    public function variantValue()
    {
        return $this->belongsTo(VariantValue::class, 'variant_value_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
