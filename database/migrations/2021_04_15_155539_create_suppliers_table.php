<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("city",100);
            $table->string("state",100);
            $table->text("address");
            $table->string("contact_no",15);
            $table->string("gst_no",25);
            $table->string("pan_no",25);
            $table->string("contact_per_name",100);
            $table->string("company_name",100);
            $table->tinyInteger("publish");
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
        Schema::dropIfExists('suppliers');
    }
}
