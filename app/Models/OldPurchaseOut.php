<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldPurchaseOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_out_no', 'file'
    ];
}
