<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedGoodsDispatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_goods_dispatch', function (Blueprint $table) {
            $table->id();
            $table->string("dispath_no",20);
            $table->string("dispatch_form",100);
            $table->string("dispatch_to",100);
            $table->string("good_dispatch_date",20);
            $table->integer("mode_of_dispatch");
            $table->string("party_name",255);
            $table->integer("product");
            $table->string("invoice_no",100);
            $table->string("batch_no",100);
            $table->integer("grade");
            $table->string("viscosity",100)->nullable();
            $table->string("mfg_date",100);
            $table->string("expiry_ratest_date",100);
            $table->integer("total_no_of_200kg_drums")->nullable();
            $table->integer("total_no_of_50kg_drums")->nullable();
            $table->integer("total_no_of_30kg_drums")->nullable();
            $table->integer("total_no_of_5kg_drums")->nullable();
            $table->integer("total_no_qty");
            $table->string("seal_no",100);
            $table->string("dispatch_date",20);
            $table->integer("dispatch_by");
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
        Schema::dropIfExists('finished_goods_dispatch');
    }
}
