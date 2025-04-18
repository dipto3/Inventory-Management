<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturnItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purchaseReturn()
    {
        return $this->belongsTo(PurchaseReturn::class);
    }
    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class);  
    }
    public function returnReason()
    {
        return $this->belongsTo(ReturnReason::class);
    }



}
