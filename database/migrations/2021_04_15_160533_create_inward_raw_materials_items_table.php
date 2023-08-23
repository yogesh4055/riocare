<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInwardRawMaterialsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inward_raw_materials_items', function (Blueprint $table) {
            $table->id();
            $table->integer("inward_raw_material_id")->unsigned();
            $table->foreign('inward_raw_material_id')->references('id')->on('inward_raw_materials')->onDelete('cascade');
            $table->integer("material");
            $table->string("batch_no",100);
            $table->integer("total_no_of_containers_or_bags");
            $table->integer("qty_received_kg");
            $table->string("mfg_date",20);
            $table->string("mfg_expiry_date",20);
            $table->string("rio_care_expiry_date",20);
            $table->string("ar_no_date",20);
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
        Schema::dropIfExists('inward_raw_materials_items');
    }
}
