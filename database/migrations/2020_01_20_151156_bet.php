<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bet', function (Blueprint $table) {
            $table->bigIncrements('idBetting');
            $table->string('idUser');
            $table->foreign('idUser')->references('idUser')->on('users');
            $table->unsignedBigInteger('idMatch');
            $table->foreign('idMatch')->references('idMatch')->on('match');
            $table->integer('scorePredHome');
            $table->integer('scorePredAway');
            $table->dateTime('bettingTime')->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bet');
    }
}
