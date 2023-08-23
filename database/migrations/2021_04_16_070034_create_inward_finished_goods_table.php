<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInwardFinishedGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inward_finished_goods', function (Blueprint $table) {
            $table->id();
            $table->string("inward_no",100);
            $table->string("inward_date",20);
            $table->string("product_name",100);
            $table->string("batch_no",50);
            $table->integer("grade")->unsigned();
            $table->foreign('grade')->references('id')->on('grades')->onDelete('cascade');
            $table->string("viscosity")->nullable();
            $table->string("mfg_date",20);
            $table->string("expiry_ratest_date",20);
            $table->integer("total_no_of_200kg_drums")->nullable();
            $table->integer("total_no_of_50kg_drums")->nullable();
            $table->integer("total_no_of_30kg_drums")->nullable();
            $table->integer("total_no_of_5kg_drums")->nullable();
            $table->integer("total_no_of_fiber_board_drums")->nullable();
            $table->double("total_quantity");
            $table->string("ar_no",30)->nullable();
            $table->string("approval_data",20);
            $table->integer("received_by");
            $table->longText("remark")->nullable();;
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
        Schema::dropIfExists('inward_finished_goods');
    }
}
