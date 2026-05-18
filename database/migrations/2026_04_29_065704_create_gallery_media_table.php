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
    Schema::create('gallery_media', function (Blueprint $table) {
        $table->id();
        $table->foreignId('album_id')->constrained('gallery_albums')->onDelete('cascade');
        $table->enum('type', ['image', 'video']);
        $table->string('file_path');                  // Resim için dosya yolu
        $table->string('video_url')->nullable();      // Video için YouTube/Vimeo URL
        $table->string('thumbnail')->nullable();
        $table->string('title')->nullable();
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_media');
    }
};
