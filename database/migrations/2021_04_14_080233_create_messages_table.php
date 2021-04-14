<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("flat_id");
            $table->string("sender_mail", 319);
            $table->string("sender_name", 64);
            $table->string("sender_surname", 64);
            $table->text("message_content");
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
        Schema::dropIfExists('messages');
    }
}
