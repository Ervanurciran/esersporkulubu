<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->enum('media_type', ['image', 'video'])->default('image')->after('image');
            $table->string('video_path')->nullable()->after('media_type');
            $table->string('video_url')->nullable()->after('video_path');
        });
    }

    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'video_path', 'video_url']);
        });
    }
};