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
        Schema::create('facility_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('category')->nullable();
            $table->json('highlights')->nullable();
            $table->string('wa_link_text')->nullable();
            $table->string('wa_number')->nullable();
            $table->string('wa_prefilled_message')->nullable();
            $table->boolean('has_appointment_cta')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_services');
    }
};
