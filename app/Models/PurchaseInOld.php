<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInOld extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_number','file'
     ];
}
