<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueMaterialProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_material_production', function (Blueprint $table) {
            $table->id();
            $table->string("requisition_no",50);
            $table->integer("material");
            $table->integer("opening_bal");
            $table->string("batch_no",50);
            $table->string("viscosity",50)->nullable();
            $table->string("issual_date",20);
            $table->double("issued_quantity");
            $table->double("excess");
            $table->double("wastage");
            $table->double("returned_from_day_store");
            $table->double("closing_balance_qty");
            $table->integer("dispensed_by");
            $table->longText("remark");
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
        Schema::dropIfExists('issue_material_production');
    }
}
