<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingMaterialRequisitionSlipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_material_requisition_slip', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('from');
            $table->string('to');
            $table->string('batchNo');
            $table->string('Date');
            $table->string('checkedBy');
            $table->string('ApprovedBy');
            $table->string('Remark');
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
        Schema::dropIfExists('packing_material_requisition_slip');
    }
}
