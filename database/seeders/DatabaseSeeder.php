<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use PurchaseIn;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call([UsersTableSeeder::class]);
        $this->call(QuotationTypeSeeder::class);
        $this->call(InvoiceTypeSeeder::class);
        $this->call(PurchaseInSeeder::class);
        $this->call(PurchaseOutSeeder::class);
        
    }
}
