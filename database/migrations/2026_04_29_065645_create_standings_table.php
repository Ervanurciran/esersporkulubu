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
    Schema::create('standings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('branch_id')->constrained()->onDelete('cascade');
        $table->string('season');                     // 2024-2025
        $table->string('competition')->nullable();    // Lig adı
        $table->string('team_name');
        $table->string('team_logo')->nullable();
        $table->integer('played')->default(0);        // Oynadı
        $table->integer('won')->default(0);           // Kazandı
        $table->integer('drawn')->default(0);         // Berabere
        $table->integer('lost')->default(0);          // Kaybetti
        $table->integer('goals_for')->default(0);     // Attığı
        $table->integer('goals_against')->default(0); // Yediği
        $table->integer('points')->default(0);        // Puan
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
