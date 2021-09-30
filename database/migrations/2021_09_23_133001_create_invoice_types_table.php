<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD:database/migrations/2021_09_25_071722_create_quotation_type_details_table.php
class CreateQuotationTypeDetailsTable extends Migration
=======
class CreateInvoiceTypesTable extends Migration
>>>>>>> 7324a0aa12f5ea121891c682ddb0bac4993309b1:database/migrations/2021_09_23_133001_create_invoice_types_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2021_09_25_071722_create_quotation_type_details_table.php
        Schema::create('quotation_type_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('quotation_types');
            $table->date('quotation_date');
            $table-> bigInteger('quantity')->default(1);
=======
        Schema::create('invoice_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
>>>>>>> 7324a0aa12f5ea121891c682ddb0bac4993309b1:database/migrations/2021_09_23_133001_create_invoice_types_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD:database/migrations/2021_09_25_071722_create_quotation_type_details_table.php
        Schema::dropIfExists('quotation_type_details');
=======
        Schema::dropIfExists('invoice_types');
>>>>>>> 7324a0aa12f5ea121891c682ddb0bac4993309b1:database/migrations/2021_09_23_133001_create_invoice_types_table.php
    }
}
