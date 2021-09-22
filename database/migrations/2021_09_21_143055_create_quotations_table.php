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
            $table->bigInteger('type_id');
            $table->bigInteger('item_id')->nullable();
            $table->string('Customer');
            $table->string('Attention');
            $table->string('Payment Term');
            $table->date('Quotation Date');
            $table->bigInteger('Account Manager');
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
