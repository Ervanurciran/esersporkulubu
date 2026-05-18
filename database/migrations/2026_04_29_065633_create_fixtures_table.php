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
    Schema::create('fixtures', function (Blueprint $table) {
        $table->id();
        $table->foreignId('branch_id')->constrained()->onDelete('cascade');
        $table->string('home_team');
        $table->string('away_team');
        $table->string('home_team_logo')->nullable();
        $table->string('away_team_logo')->nullable();
        $table->dateTime('match_date');
        $table->string('venue')->nullable();          // Stat / Salon
        $table->string('competition')->nullable();    // Lig, Kupa vb.
        $table->enum('status', ['upcoming', 'live', 'completed'])->default('upcoming');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
