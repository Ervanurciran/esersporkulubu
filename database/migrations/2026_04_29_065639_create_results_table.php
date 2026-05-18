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
    Schema::create('results', function (Blueprint $table) {
        $table->id();
        $table->foreignId('branch_id')->constrained()->onDelete('cascade');
        $table->foreignId('fixture_id')->nullable()->constrained()->onDelete('set null');
        $table->string('home_team');
        $table->string('away_team');
        $table->string('home_team_logo')->nullable();
        $table->string('away_team_logo')->nullable();
        $table->integer('home_score');
        $table->integer('away_score');
        $table->dateTime('match_date');
        $table->string('competition')->nullable();
        $table->text('summary')->nullable();          // Maç özeti
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
