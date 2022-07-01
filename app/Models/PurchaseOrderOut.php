<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderOut extends Model
{
    protected $fillable = [
        'po_out_no',
        'date',
        'arrival',
        'to',
        'attn',
        'email',
        'ppn',
        'terms'
    ];
}
