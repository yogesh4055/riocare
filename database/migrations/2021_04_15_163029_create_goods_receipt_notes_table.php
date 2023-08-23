<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsReceiptNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_receipt_notes', function (Blueprint $table) {
            $table->increments("id");
            $table->string("goods_going_from",100);
            $table->string("goods_going_to",100);
            $table->string("date_of_receipt",20);
            $table->integer("manufacurer");
            $table->integer("supplier");
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
        Schema::dropIfExists('goods_receipt_notes');
    }
}
