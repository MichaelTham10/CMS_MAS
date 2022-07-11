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
        'terms',
        'deliver_to',
        'attn_makro',
        "makro_phone_no", 
    ];
    public static function getFormatId($id, $po_date)
    {
   
        $date = date('Ym', strtotime($po_date));
        echo($date);
        return sprintf('MAS/PO/'.$date.'%02d',$id);

    }
}
