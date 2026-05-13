<?php

use App\Enums\EconomicStatus;
use App\Enums\EducationLevel;
use App\Enums\HouseCondition;
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
        Schema::create('social_economics', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('citizen_id')->nullable()->constrained('citizens')->onDelete('set null');
            $table->enum('education_level', array_column(EducationLevel::cases(), 'value'));
            $table->string('occupation', 100);
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->boolean('is_welfare_recipient')->default(false);
            $table->string('assistance_type', 255)->nullable();
            $table->enum('house_condition', array_column(HouseCondition::cases(), 'value'));
            $table->enum('economic_status', array_column(EconomicStatus::cases(), 'value'));

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_economics');
    }
};
