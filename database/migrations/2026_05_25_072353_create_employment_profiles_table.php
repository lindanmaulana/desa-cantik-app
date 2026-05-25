<?php

use App\Enums\EconomicStatus;
use App\Enums\EmploymentStatus;
use App\Enums\JobSector;
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
        Schema::create('employment_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('citizen_id')->constrained('citizens')->cascadeOnDelete();
            $table->string('occupation', 100);
            $table->enum('job_sector', array_column(JobSector::cases(), 'value'))->default(JobSector::OTHER->value);
            $table->enum('employment_status', array_column(EmploymentStatus::cases(), 'value'))->default(EmploymentStatus::UNPAID_WORKER->value);
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->enum('economic_status', array_column(EconomicStatus::cases(), 'value'));
            $table->boolean('is_welfare_recipient')->default(false);
            $table->string('assistance_type', 100)->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_profiles');
    }
};
