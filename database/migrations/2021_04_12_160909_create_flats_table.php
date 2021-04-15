<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->double("lat", 11, 8);
            $table->double("lon", 11, 8);
            $table->string("street_number", 8);
            $table->string("street_name", 64);
            $table->string("municipality", 64);
            $table->string("country_secondary_subdivision", 64);
            $table->string("country_subdivision", 32);
            $table->unsignedMediumInteger("postal_code");
            $table->timestamps();

            $table->foreign("user_id")
            ->references("id")
                ->on("users");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flats');
    }
}
