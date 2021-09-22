<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id','type_detail_id', 'item_id', 'Customer',
        'Attention', 'Payment Term', 'Quotation Date',
        'Account Manager', 'Discount', 'Terms'
    ];


    public function getFormatId($type_id,$type_detail_id,$quotation_date)
    {
        $type = QuotationType::findOrFail($type_id);
        
        $date = date('Ym', strtotime($quotation_date));

        return sprintf('MAS/'.$type->alias.'/'.$date.'%03d',$type_detail_id);

    }
}
