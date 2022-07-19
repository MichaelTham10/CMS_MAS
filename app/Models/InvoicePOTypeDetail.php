<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePOTypeDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id', 'invoice_date', 'quantity',
    ];
}
