<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_out_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('po_out_id')->unsigned();
            $table->foreign('po_out_id')->references('id')->on('purchase_order_outs');
            $table->string('item_description');
            $table->bigInteger('qty');
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
        Schema::dropIfExists('purchase_out_items');
    }
}
