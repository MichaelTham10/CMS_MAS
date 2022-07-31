<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_order_ins')->insert([
            'customer_number' => '100',
            'customer_name' => 'PT Test',
            'file' => 'public/pdf/test.pdf',
            'po_date' => '2022-01-27'
        ]);
    }
}
