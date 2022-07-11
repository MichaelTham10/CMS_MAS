<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseIn extends Model
{
    use HasFactory;

    public $table = 'purchase_order_in';

    protected $fillable = [
        'attention','customer_number','company_name','date','purchase_in','file'
    ];
}
