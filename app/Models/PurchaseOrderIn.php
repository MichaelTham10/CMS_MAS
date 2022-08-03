<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_number','customer_name','file', 'po_date', 'full_paid'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\ItemPurchaseIn', 'po_in_id');
    }
}
