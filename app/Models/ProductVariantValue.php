<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantValue extends Model
{
    use HasFactory;
    // protected $fillable = ['product_variant_id', 'variant_id', 'variant_value_id'];
    protected $guarded =[''];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function variantValue()
    {
        return $this->belongsTo(VariantValue::class);
    }
}
