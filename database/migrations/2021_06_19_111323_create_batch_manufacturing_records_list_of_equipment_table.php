<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchManufacturingRecordsListOfEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('batch_manufacturing_records_list_of_equipment');
        Schema::create('batch_manufacturing_records_list_of_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('proName')->nullable();
            $table->string('bmrNo')->nullable();
            $table->string('batchNo')->nullable();
            $table->string('refMfrNo')->nullable();
            $table->string('Remark')->nullable();
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
        Schema::dropIfExists('batch_manufacturing_records_list_of_equipment');
    }
}
