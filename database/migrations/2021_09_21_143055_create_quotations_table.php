<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('quotation_types');

            $table->bigInteger('type_detail_id')->unsigned();
            $table->foreign('type_detail_id')->references('id')->on('quotation_type_details');

            $table->string('Quotation_No');
            $table->bigInteger('type_detail_quantity');
            $table->bigInteger('item_id')->nullable();
            $table->string('Customer');
            $table->string('Attention');
            $table->string('Payment Term');
            $table->date('Quotation Date');
            $table->string('Account Manager');
            $table->bigInteger('Discount');
            $table->string('Terms');
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
        Schema::dropIfExists('quotations');
    }
}
