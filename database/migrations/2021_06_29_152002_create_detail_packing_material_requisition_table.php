<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPackingMaterialRequisitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_packing_material_requisition', function (Blueprint $table) {
            $table->id();
            $table->string('PackingMaterialName');
            $table->string('Capacity');
            $table->string('Quantity');
            $table->string('requisition_id');
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
        Schema::dropIfExists('detail_packing_material_requisition');
    }
}
