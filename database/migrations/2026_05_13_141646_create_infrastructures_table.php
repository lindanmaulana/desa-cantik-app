<?php

use App\Enums\ConditionInfrastructure;
use App\Enums\FacilityType;
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
        Schema::create('infrastructures', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('facility_name', 255);
            $table->enum('facility_type', array_column(FacilityType::cases(), 'value'));
            $table->enum('condition', array_column(ConditionInfrastructure::cases(), 'value'))->default(ConditionInfrastructure::GOOD->value);
            $table->year('construction_year')->nullable();
            $table->string('funding_source', 100);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infrastructures');
    }
};
