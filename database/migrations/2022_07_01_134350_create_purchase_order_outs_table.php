<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_outs', function (Blueprint $table) {
            $table->id();
            $table->string('po_out_no');
            $table->date('date');
            $table->date('arrival');
            $table->string('to');
            $table->string('attn');
            $table->string('email');
            $table->integer('ppn');
            $table->longText('terms');
            $table->string('deliver_to');
            $table->string('attn_makro');
            $table->string('makro_phone_no');
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
        Schema::dropIfExists('purchase_order_outs');
    }
}
