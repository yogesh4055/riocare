<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillOfRawMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bill_of_raw_material_details');
        Schema::create('bill_of_raw_material_details', function (Blueprint $table) {
            $table->id();
            $table->string('rawMaterialName')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('batchNo')->nullable();
            $table->string('arNo')->nullable();
            $table->string('date')->nullable();
            $table->string('bill_of_raw_material_id')->nullable();
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
        Schema::dropIfExists('bill_of_raw_material_details');
    }
}
