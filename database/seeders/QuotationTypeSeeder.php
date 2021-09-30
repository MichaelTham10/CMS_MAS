<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quotation_types')->insert([
            'name' => 'Quotation Devices',
            'alias' => 'SO'
        ]);
        DB::table('quotation_types')->insert([
            'name' => 'Quotation Manage Service',
            'alias' => 'MS'
        ]);
        DB::table('quotation_types')->insert([
            'name' => 'Quotation Monthly Services',
            'alias' => 'MMS'
        ]);
    }
}
