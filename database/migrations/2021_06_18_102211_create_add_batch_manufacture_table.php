<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddBatchManufactureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('add_batch_manufacture');
        Schema::create('add_batch_manufacture', function (Blueprint $table) {
          $table->id();
          $table->string('proName')->nullable();
          $table->string('bmrNo')->nullable();
          $table->string('batchNo')->nullable();
          $table->string('refMfrNo')->nullable();
          $table->string('grade')->nullable();
          $table->string('BatchSize')->nullable();
          $table->string('Viscosity')->nullable();
          $table->string('ProductionCommencedon')->nullable();
          $table->string('ProductionCompletedon')->nullable();
          $table->string('ManufacturingDate')->nullable();
          $table->string('RetestDate')->nullable();
          $table->string('doneBy')->nullable();
          $table->string('checkedBy')->nullable();
          $table->string('inlineRadioOptions')->nullable();
          $table->string('approval')->nullable();
          $table->string('approvalDate')->nullable();
          $table->string('checkedByI')->nullable();
          $table->string('Remark')->nullable();
          $table->integer('is_delete')->nullable();
          $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('add_batch_manufacture');
    }
}
