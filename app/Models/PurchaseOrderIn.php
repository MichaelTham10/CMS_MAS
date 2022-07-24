<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_number','customer_name','file', 'active'
     ];
     public function items()
    {
        return $this->hasMany('App\Models\ItemPurchaseIn');
    }
}
