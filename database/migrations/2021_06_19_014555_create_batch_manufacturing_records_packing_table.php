<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchManufacturingRecordsPackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_manufacturing_records_packing', function (Blueprint $table) {
            $table->id();
            $table->string('proName')->nullable();
            $table->string('bmrNo')->nullable();
            $table->string('batchNo')->nullable();
            $table->string('refMfrNo')->nullable();
            $table->string('ManufacturerDate')->nullable();
            $table->string('Observation')->nullable();
            $table->string('Temperature')->nullable();
            $table->string('Humidity')->nullable();
            $table->string('TemperatureP')->nullable();
            $table->string('50kgDrums')->nullable();
            $table->string('20kgDrums')->nullable();
            $table->string('startTime')->nullable();
            $table->string('EndstartTime')->nullable();
            $table->string('areaCleanliness')->nullable();
            $table->string('CareaCleanliness')->nullable();
            $table->string('rmInput')->nullable();
            $table->string('fgOutput')->nullable();
            $table->string('filledDrums')->nullable();
            $table->string('excessFilledDrums')->nullable();
            $table->string('qcsampling')->nullable();
            $table->string('StabilitySample')->nullable();
            $table->string('WorkingSlandered')->nullable();
            $table->string('ValidationSample')->nullable();
            $table->string('CustomerSample')->nullable();
            $table->string('ActualYield')->nullable();
            $table->string('checkedBy')->nullable();
            $table->string('ApprovedBy')->nullable();
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
        Schema::dropIfExists('batch_manufacturing_records_packing');
    }
}
