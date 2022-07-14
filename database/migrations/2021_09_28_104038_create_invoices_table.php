<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('invoice_types');
            $table->bigInteger('type_detail_id')->unsigned();
            $table->foreign('type_detail_id')->references('id')->on('invoice_type_details');
            $table->string('Invoice No');
            $table->bigInteger('type_detail_quantity');
            $table->string('Address');
            $table->date('Invoice Date');
            // $table->bigInteger('Quotation No')->unsigned();
            // $table->foreign('Quotation No')->references('id')->on('quotations');
            $table->string('read_number');
            $table->string('Bill To');
            $table->string('Note');
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
        Schema::dropIfExists('invoices');
    }
}
