<?php

namespace App\Models\quotation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationTypeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'quotation_date', 'quantity',
    ];

}
