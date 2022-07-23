<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPurchaseInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_purchase_ins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('po_in_id')->unsigned();
            $table->foreign('po_in_id')->references('id')->on('purchase_order_ins')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('description');
            $table->bigInteger('quantity');
            $table->bigInteger('price');
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
        Schema::dropIfExists('item_purchase_ins');
    }
}
