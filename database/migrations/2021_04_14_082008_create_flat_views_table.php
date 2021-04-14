<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("flat_id");
            $table->string("viewer_ip");
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
        Schema::dropIfExists('flat_views');
    }
}
