<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldQuotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'Quotation_No', 'file'
    ];
}
