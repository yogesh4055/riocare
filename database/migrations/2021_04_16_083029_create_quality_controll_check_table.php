<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityControllCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_controll_check', function (Blueprint $table) {
            $table->id();
            $table->integer("meterial");
            $table->integer("quantity_approved");
            $table->integer("quantity_rejected");
            $table->string("quantity_status");
            $table->string("date_of_approval");
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
        Schema::dropIfExists('quality_controll_check');
    }
}
