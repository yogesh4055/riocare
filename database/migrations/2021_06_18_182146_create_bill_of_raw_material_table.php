<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillOfRawMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bill_of_raw_material');
        Schema::create('bill_of_raw_material', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('proName')->nullable();
            $table->string('batchNoI')->nullable();
            $table->string('bmrNo')->nullable();
            $table->string('refMfrNo')->nullable();
            $table->string('checkedBy')->nullable();
            $table->string('doneBy')->nullable();
            $table->string('Remark')->nullable();
            $table->integer('is_active')->nullable();
            $table->integer('is_delete')->nullable();
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
        Schema::dropIfExists('bill_of_raw_material');
    }
}
