<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInwardRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inward_raw_materials', function (Blueprint $table) {
            $table->increments("id");
            $table->string("inward_no",40);
            $table->string("received_from",125);
            $table->string("received_to",125);
            $table->string("date_of_receipt",20);
            $table->integer("material");
            $table->integer("manufacturer");
            $table->integer("supplier");
            $table->text("supplier_address");
            $table->string("supplier_gst");
            $table->string("invoice_no",100);
            $table->string("goods_receipt_no",100);
            $table->integer("created_by");
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
        Schema::dropIfExists('inward_raw_materials');
    }
}
