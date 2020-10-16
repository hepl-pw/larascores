<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained();
            $table->foreignId('tournament_id')->nullable()->constrained();
            $table->unsignedTinyInteger('games')->nullable(false)->default(0);
            $table->unsignedTinyInteger('points')->nullable(false)->default(0);
            $table->unsignedTinyInteger('wins')->nullable(false)->default(0);
            $table->unsignedTinyInteger('losses')->nullable(false)->default(0);
            $table->unsignedTinyInteger('draws')->nullable(false)->default(0);
            $table->unsignedTinyInteger('goals_for')->nullable(false)->default(0);
            $table->unsignedTinyInteger('goals_against')->nullable(false)->default(0);
            $table->TinyInteger('goals_difference')->nullable(false)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_stats');
    }
}
