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
        Schema::table('articles', function (Blueprint $table) {
            $table->renameColumn('thumbnail', 'image_path');
        });

        Schema::table('facility_services', function (Blueprint $table) {
            $table->renameColumn('icon_path', 'image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->renameColumn('image_path', 'thumbnail');
        });

        Schema::table('facility_services', function (Blueprint $table) {
            $table->renameColumn('image_path', 'icon_path');
        });
    }
};
