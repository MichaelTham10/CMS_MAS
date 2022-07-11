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
        DB::table('purchase_order_in')->insert([
            'attention' => 'System',
            'customer_number' => '100',
            'company_name' => 'PT Test',
            'date' => '2021-12-14 00:00:00',
            'file' => 'public/pdf/test.pdf'
        ]);
        DB::table('purchase_order_in')->insert([
            'attention' => 'System',
            'customer_number' => '100',
            'company_name' => 'PT Test',
            'date' => '2021-12-14 00:00:00',
            'file' => 'public/pdf/test.pdf'
        ]);
        DB::table('purchase_order_in')->insert([
            'attention' => 'System',
            'customer_number' => '100',
            'company_name' => 'PT Test',
            'date' => '2021-12-14 00:00:00',
            'file' => 'public/pdf/test.pdf'
        ]);
        DB::table('purchase_order_in')->insert([
            'attention' => 'System',
            'customer_number' => '100',
            'company_name' => 'PT Test',
            'date' => '2021-12-14 00:00:00',
            'file' => 'public/pdf/test.pdf'
        ]);
    }
}
