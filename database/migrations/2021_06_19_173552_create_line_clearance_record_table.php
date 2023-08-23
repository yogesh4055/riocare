<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineClearanceRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('line_clearance_record');
        Schema::create('line_clearance_record', function (Blueprint $table) {
            $table->id();
            $table->string('EquipmentName')->nullable();
            $table->string('Observation')->nullable();
            $table->string('time')->nullable();
            $table->integer('line_clearance_id')->nullable();
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
        Schema::dropIfExists('line_clearance_record');
    }
}
