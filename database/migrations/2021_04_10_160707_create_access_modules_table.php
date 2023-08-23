<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_modules', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->integer("controller_id")->unsigned();
            $table->foreign('controller_id')->references('id')->on('controllers')->onDelete('RESTRICT');
            $table->integer("action_id")->unsigned();
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('RESTRICT');

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
        Schema::dropIfExists('access_modules');
    }
}
