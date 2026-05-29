<?php

use App\Enums\CookingFuel;
use App\Enums\ElectricityCapacity;
use App\Enums\ElectricitySource;
use App\Enums\FloorMaterial;
use App\Enums\HouseCondition;
use App\Enums\HouseOwnership;
use App\Enums\RoofMaterial;
use App\Enums\SanitationType;
use App\Enums\WallMaterial;
use App\Enums\WaterSource;
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
        Schema::create('housing_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('family_id')->constrained('families')->cascadeOnDelete();

            $table->enum('house_ownership', array_column(HouseOwnership::cases(), 'value'))->default(HouseOwnership::OWNED->value);
            $table->enum('house_condition', array_column(HouseCondition::cases(), 'value'))->default(HouseCondition::PROPER->value);
            $table->enum('floor_material', array_column(FloorMaterial::cases(), 'value'))->default(FloorMaterial::CEMENT_BRICK->value);
            $table->enum('wall_material', array_column(WallMaterial::cases(), 'value'))->default(WallMaterial::MASONRY_BRICK->value);
            $table->enum('roof_material', array_column(RoofMaterial::cases(), 'value'))->default(RoofMaterial::CLAY_TILE->value);
            $table->enum('water_source', array_column(WaterSource::cases(), 'value'))->default(WaterSource::PROTECTED_WELL->value);
            $table->enum('sanitation_type', array_column(SanitationType::cases(), 'value'))->default(SanitationType::PRIVATE_FLUSH_TOILET->value);
            $table->enum('cooking_fuel', array_column(CookingFuel::cases(), 'value'))->default(CookingFuel::LPG_GAS->value);
            $table->enum('electricity_source', array_column(ElectricitySource::cases(), 'value'))->default(ElectricitySource::PLN_METERED->value);
            $table->enum('electricity_capacity', array_column(ElectricityCapacity::cases(), 'value'))->default(ElectricityCapacity::VA_900->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('housing_profiles');
    }
};
