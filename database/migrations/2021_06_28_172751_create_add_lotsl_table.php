<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddLotslTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_lotsl', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('proName')->nullable();
            $table->string('bmrNo')->nullable();
            $table->string('batchNo')->nullable();
            $table->string('refMfrNo')->nullable();
            $table->string('Date')->nullable();
            $table->string('lotNo')->nullable();
            $table->string('ReactorNo')->nullable();
            $table->string('Process_date')->nullable();

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
        Schema::dropIfExists('add_lotsl');
    }
}
