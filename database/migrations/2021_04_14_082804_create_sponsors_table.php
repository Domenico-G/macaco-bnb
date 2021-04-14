<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("flat_id");
            $table->unsignedBigInteger("sponsor_type_id");
            $table->date("sponsor_start");
            $table->date("sponsor_end");
            $table->timestamps();

            $table->foreign("flat_id")
            ->references("id")
            ->on("flats");

            $table->foreign("sponsor_type_id")
            ->references("id")
            ->on("sponsor_types");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
