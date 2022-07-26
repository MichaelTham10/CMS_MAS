<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'Invoice_No', 'file'
    ];
}
