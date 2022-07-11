<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_order_outs')->insert([
            'po_out_no' => "2022-05-01",
            'date' => '2022/12/15',
            'arrival' => '2022/12/20',
            'to' => 'Axel',
            'attn' => 'Ronaldo',
            'email' => "ronaldo@siuuu.com",
            'ppn' => 11,
            'terms' => "testing",
            'deliver_to' => "Jl. Pakualam",
            'attn_makro' => "Maikel",
            "makro_phone_no" => "08977777777",
        ]);
        DB::table('purchase_order_outs')->insert([
            'po_out_no' => "2022-05-02",
            'date' => '2022/12/16',
            'arrival' => '2022/12/20',
            'to' => 'Neymar',
            'attn' => 'Maguire',
            'email' => "maguire@siuuu.com",
            'ppn' => 11,
            'terms' => "testing",
            'deliver_to' => "Jl. Pakualam",
            'attn_makro' => "Maikel",
            "makro_phone_no" => "08977777777",  
        ]);
    }
}
