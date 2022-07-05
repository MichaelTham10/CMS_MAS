<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOutItem extends Model
{
    protected $fillable = [
        'po_out_id','item_description','qty','price'
    ];
}
