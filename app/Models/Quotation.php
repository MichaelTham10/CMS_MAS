<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id','type_detail_id', 'Quotation_No', 'type_detail_quantity', 'item_id', 'Customer',
        'Attention', 'Payment Term', 'Quotation Date',
        'Account Manager', 'Discount', 'Terms', 'full_paid'
    ];


    public function type()
    {
       return $this->belongsTo('App\Models\QuotationType');
    }

    // public function invoice()
    // {
    //    return $this->hasMany('App\Models\Invoice');
    // }

    public function items()
    {
        // $items = Item::where('quotation_id', $id)->get();
        // return $items;
        return $this->hasMany('App\Models\Item');
    }

    public function test($id)
    {
        $items = Item::where('quotation_id', $id)->get();
        return $items;
    }

    public static function getFormatId($type_id,$type_detail_id,$quotation_date)
    {
        $type = QuotationType::findOrFail($type_id);
        
        $date = date('Ym', strtotime($quotation_date));

        return sprintf('MAS/'.$type->alias.'/'.$date.'%03d',$type_detail_id);

    }

    
}
