<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfEquipmentInManufacturinProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_of_equipment_in_manufacturin_process', function (Blueprint $table) {
            $table->id();
            $table->string('EquipmentName')->nullable();
            $table->string('EquipmentCode')->nullable();
            $table->integer('batch_manufacturing_id')->nullable();
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
        Schema::dropIfExists('list_of_equipment_in_manufacturin_process');
    }
}
