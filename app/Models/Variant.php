<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $guarded =[''];

    public function variantValues()
    {
        return $this->hasMany(VariantValue::class);
    }
}
