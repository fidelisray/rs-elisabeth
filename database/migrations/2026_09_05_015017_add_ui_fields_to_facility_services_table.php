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
        Schema::table('facility_services', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name')->nullable();
            $table->text('short_description')->after('description')->nullable();
            $table->json('highlights')->after('short_description')->nullable();
            $table->string('wa_link_text')->after('icon_path')->nullable();
            $table->string('wa_link_url')->after('wa_link_text')->nullable();
            $table->boolean('has_appointment_cta')->after('wa_link_url')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facility_services', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'short_description',
                'highlights',
                'wa_link_text',
                'wa_link_url',
                'has_appointment_cta'
            ]);
        });
    }
};
