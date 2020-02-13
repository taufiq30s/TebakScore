<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Match extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->bigIncrements('idMatch');
            $table->unsignedBigInteger('idTeamHome');
            $table->foreign('idTeamHome')->references('idTeam')->on('team');
            $table->integer('scoreTeamHome');
            $table->unsignedBigInteger('idTeamAway');
            $table->foreign('idTeamAway')->references('idTeam')->on('team');
            $table->integer('scoreTeamAway');
            $table->binary('isSetted')->default('0');
            $table->dateTime('matchTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match');
    }
}
