<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderOutDetails extends Model
{
    protected $fillable = [
        "po_out_date",
        "quantity"
    ];
}
