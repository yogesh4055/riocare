<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_details', function (Blueprint $table) {
            $table->id();
            $table->string('PackingMaterialName')->nullable();
            $table->string('Capacity')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('arNo')->nullable();
            $table->string('ARDate')->nullable();
            $table->integer('packingmaterial_id')->nullable();
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
        Schema::dropIfExists('material_details');
    }
}
