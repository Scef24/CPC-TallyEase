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
        Schema::create('game_committees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')
            ->constrained('games')
            ->onDelete('cascade');
            $table->foreignId('committee_id')
            ->constrained('committees')
            ->onDelete('cascade');
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
        Schema::dropIfExists('game_committees');
    }
};
