<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Item;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id','type_detail_id', 'Invoice No', 'type_detail_quantity', 'Address',
        'Invoice Date', 'Quotation No', 'Bill To', 'Note',
    ];

    public static function getFormatId($invoiceType_id,$invoiceType_detail_id,$invoiceDate)
    {
        $type = InvoiceType::findOrFail($invoiceType_id);
        
        $date = date('Y', strtotime($invoiceDate));

        return sprintf('MAS/'.$type->alias.'/'.$date.'%03d',$invoiceType_detail_id);
    }

    public function type(){
        return $this->belongsTo('App\Models\InvoiceType');
    }

    public function quotation(){
        return $this->belongsTo('App\Models\Quotation', 'Quotation No');
    }

    public function items($id)
    {
        $items = Item::where('quotation_id', $id)->get();
        return $items;
    }
}
