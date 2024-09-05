<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negotiationID')->unsigned();
            $table->unsignedBigInteger('senderID')->unsigned();
            $table->text('message');
            $table->timestamps();

            // Foreign keys
            $table->foreign('negotiationID')->references('negotiationID')->on('negotiations')->onDelete('cascade');
            $table->foreign('senderID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('replies');
    }
}