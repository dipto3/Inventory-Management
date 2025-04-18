<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function purchaseReturnItems()
    {
        return $this->hasMany(PurchaseReturnItem::class);
    }
    
}
