<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsReceiptNoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_receipt_note_items', function (Blueprint $table) {
            $table->id();
            $table->integer("good_receipt_id")->unsigned();
            $table->foreign('good_receipt_id')->references('id')->on('goods_receipt_notes')->onDelete('cascade');
            $table->integer("material");
            $table->integer("total_qty");
            $table->string("ar_no_date",20);
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
        Schema::dropIfExists('goods_receipt_note_items');
    }
}
