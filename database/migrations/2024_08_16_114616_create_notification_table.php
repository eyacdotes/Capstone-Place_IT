<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notificationID');
            $table->unsignedBigInteger('userID'); 
            $table->foreign('userID')->references('userID')->on('users'); // Reference the correct column
            $table->string('description');
            $table->string('notificationType');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};

