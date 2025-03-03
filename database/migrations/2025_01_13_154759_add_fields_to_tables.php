<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jugadores', function (Blueprint $table) {
            $table->date('data_naixement')->nullable();
            $table->integer('dorsal')->nullable();
        });

        Schema::table('partits', function (Blueprint $table) {
            $table->unsignedBigInteger('estadi_id')->nullable();
            $table->unsignedBigInteger('arbitre_id')->nullable();
            $table->date('data')->nullable();
            $table->integer('jornada')->nullable();

            $table->foreign('estadi_id')->references('id')->on('estadis')->onDelete('set null');
            $table->foreign('arbitre_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jugadores', function (Blueprint $table) {
            $table->dropColumn(['data_naixement', 'dorsal']);
        });

        Schema::table('partits', function (Blueprint $table) {
            $table->dropForeign(['estadi_id']);
            $table->dropForeign(['arbitre_id']);
            $table->dropColumn(['estadi_id', 'arbitre_id', 'data', 'jornada']);
        });
    }
};
