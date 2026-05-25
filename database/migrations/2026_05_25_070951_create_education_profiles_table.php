<?php

use App\Enums\EducationLevel;
use App\Enums\SchoolParticipation;
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
        Schema::create('education_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('citizen_id')->constrained('citizens')->cascadeOnDelete();
            $table->enum('education_level', array_column(EducationLevel::cases(), 'value'))->default(EducationLevel::NONE->value);
            $table->enum('highest_diploma', array_column(EducationLevel::cases(), 'value'))->default(EducationLevel::NONE->value);
            $table->enum('school_participation', array_column(SchoolParticipation::cases(), 'value'))->default(SchoolParticipation::NOT_YET_IN_SCHOOL->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_profiles');
    }
};
