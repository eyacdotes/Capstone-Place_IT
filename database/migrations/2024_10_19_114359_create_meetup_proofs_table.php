<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetup_proofs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_agreement_id');
            $table->string('proof_image');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('rental_agreement_id')->references('rentalAgreementID')->on('rental_agreements')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetup_proofs');
    }
};
