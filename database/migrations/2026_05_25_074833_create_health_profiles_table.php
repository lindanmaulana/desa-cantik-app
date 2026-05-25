<?php

use App\Enums\BpjsStatus;
use App\Enums\DisabilityType;
use App\Enums\KbMethod;
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
        Schema::create('health_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('citizen_id')->constrained('citizens')->cascadeOnDelete();
            $table->enum('disability_type', array_column(DisabilityType::cases(), 'value'))->default(DisabilityType::NONE->value);
            $table->boolean('is_pregnant')->default(false);
            $table->enum('kb_method', array_column(KbMethod::cases(), 'value'))->default(KbMethod::NONE->value);
            $table->enum('bpjs_status', array_column(BpjsStatus::cases(), 'value'))->default(BpjsStatus::NONE->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_profiles');
    }
};
