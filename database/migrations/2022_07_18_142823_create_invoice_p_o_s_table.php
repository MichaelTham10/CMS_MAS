<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_p_o_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('invoice_types');
            $table->bigInteger('type_detail_id')->unsigned();
            $table->foreign('type_detail_id')->references('id')->on('invoice_p_o_type_details');
            $table->string('Invoice No');
            $table->bigInteger('type_detail_quantity');
            $table->string('Address');
            $table->date('Invoice Date');
            $table->bigInteger('PO_In_Id')->unsigned();
            $table->foreign('PO_In_Id')->references('id')->on('purchase_order_ins');
            $table->string('Bill To');
            $table->longText('Note');
            $table->bigInteger('service_cost');
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
        Schema::dropIfExists('invoice_p_o_s');
    }
}
