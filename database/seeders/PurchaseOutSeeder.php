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
            'po_out_no' => "MAS/PO/SIUUUUU",
            'date' => '2022/12/15',
            'arrival' => '2022/12/20',
            'to' => 'Axel',
            'attn' => 'Ronaldo',
            'email' => "ronaldo@siuuu.com",
            'ppn' => 11,
            'terms' => "testing"
        ]);
        DB::table('purchase_order_outs')->insert([
            'po_out_no' => "MAS/PO/MESSI",
            'date' => '2022/12/16',
            'arrival' => '2022/12/20',
            'to' => 'Neymar',
            'attn' => 'Maguire',
            'email' => "maguire@siuuu.com",
            'ppn' => 11,
            'terms' => "testing"
        ]);
    }
}
