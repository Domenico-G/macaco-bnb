<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("flat_id");
            $table->unsignedBigInteger("service_id");
            $table->timestamps();


            $table->foreign("flat_id")
            ->references("id")
                ->on("flats");

            $table->foreign("service_id")
            ->references("id")
            ->on("services");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flat_service');
    }
}
