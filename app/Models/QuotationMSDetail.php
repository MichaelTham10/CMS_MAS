<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationMSDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'quotation_created_date'
    ];
}
