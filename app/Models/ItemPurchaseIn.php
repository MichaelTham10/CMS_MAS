<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPurchaseIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_in_id','name','description','quantity','price'
    ];
}
