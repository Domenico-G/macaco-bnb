<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("flat_id");
            $table->string("flat_title", 128);
            $table->text("description");
            $table->string("image", 2048);
            $table->unsignedSmallInteger("area_sqm");
            $table->unsignedTinyInteger("rooms_quantity");
            $table->unsignedTinyInteger("beds_quantity");
            $table->unsignedTinyInteger("bathrooms_quantity");
            $table->unsignedSmallInteger("price_day");
            $table->boolean("visible");
            $table->timestamps();


            $table->foreign("flat_id")
            ->references("id")
            ->on("flats");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
