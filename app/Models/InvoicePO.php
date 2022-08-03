<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePO extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id','type_detail_id', 'Invoice No', 'type_detail_quantity', 'Address',
        'Invoice Date', 'PO_In_Id', 'Bill To', 'Note', 'service_cost', 'payment_status', 'dp_percent', 'dp_note',
    ];

    public static function getFormatId($invoiceType_id,$invoiceType_detail_id,$invoiceDate)
    {
        $type = InvoiceType::findOrFail($invoiceType_id);
        
        $date = date('Ym', strtotime($invoiceDate));

        return sprintf('MAS/'.$type->alias.'/'.$date.'%03d',$invoiceType_detail_id);
    }

    public function type(){
        return $this->belongsTo('App\Models\InvoiceType');
    }

    public function poin(){
        return $this->belongsTo('App\Models\PurchaseOrderIn', "PO_In_Id");
    }

    public function POitems($id)
    {
        $items = ItemPurchaseIn::where('PO_In_Id', $id)->get();
        return $items;
    }

    function addOrdinalNumberSuffix($num) {
        if (!in_array(($num % 100),array(11,12,13))){
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1:  return $num.'st';
                case 2:  return $num.'nd';
                case 3:  return $num.'rd';
            }
        }
        return $num.'th';
    }
}
