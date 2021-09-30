<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice_types')->insert([
            'name' => 'Invoice Manage Service',
            'alias' => 'MS'
        ]);
        DB::table('invoice_types')->insert([
            'name' => 'Invoice Devices',
            'alias' => 'SO'
        ]);
        DB::table('invoice_types')->insert([
            'name' => 'Invoice Monthly Service',
            'alias' => 'MMS'
        ]);
        DB::table('invoice_types')->insert([
            'name' => 'Invoice Secure Parking Project',
            'alias' => 'SPI'
        ]);
    }
}
