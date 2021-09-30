<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationTypeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_type_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('quotation_types');
            $table->date('quotation_date');
            $table-> bigInteger('quantity')->default(1);
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
        Schema::dropIfExists('quotation_type_details');
    }
}
