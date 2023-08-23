<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddLotsRawMaterialDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_lots_raw_material_detail', function (Blueprint $table) {
            $table->id();
            $table->string('EquipmentName');
            $table->string('rmbatchno');
            $table->string('Quantity');
            $table->string('add_lots_id');
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
        Schema::dropIfExists('add_lots_raw_material_detail');
    }
}
