<?php

namespace App\Models\invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTypeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'invoice_date', 'quantity',
    ];
}
