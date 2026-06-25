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
        Schema::create('village_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('village_name', 100);
            $table->string('village_code', 20);
            $table->string('subdistrict_name', 100);
            $table->string('regency_name', 100);
            $table->string('province_name', 100);

            $table->string('village_head_name', 150)->nullable()->default(null);
            $table->string('village_head_nip', 30)->nullable()->default(null);

            $table->string('app_title', 100);

            $table->string('village_logo', 255)->nullable()->default(null);
            $table->string('hero_image', 255)->nullable()->default(null);

            $table->text('office_address')->nullable()->default(null);
            $table->string('postal_code', 10)->nullable()->default(null);
            $table->string('official_email', 100)->nullable()->default(null);
            $table->string('phone_number', 20)->nullable()->default(null);

            $table->decimal('latitude', 10, 8)->nullable()->default(null);
            $table->decimal('longitude', 11, 8)->nullable()->default(null);

            $table->string('facebook_url', 255)->nullable()->default(null);
            $table->string('youtube_url', 255)->nullable()->default(null);
            $table->string('instagram_url', 255)->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_settings');
    }
};
