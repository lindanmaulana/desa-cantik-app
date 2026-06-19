<?php

use App\Enums\BumdesPartnershipStatus;
use App\Enums\BusinessCategory;
use App\Enums\CapitalSource;
use App\Enums\DigitalPlatformType;
use App\Enums\LegalEntityType;
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
        Schema::create('msmes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('citizen_id')->nullable()->constrained('citizens')->onDelete('set null');
            $table->string('business_name', 255);
            $table->enum('business_category', array_column(BusinessCategory::cases(), 'value'))->default(BusinessCategory::OTHER->value);
            $table->string('license_number', 100)->nullable();
            $table->integer('employee_count')->default(0);
            $table->decimal('monthly_revenue', 15, 2)->nullable();
            $table->enum('legal_entity_type', array_column(LegalEntityType::cases(), 'value'))->default(LegalEntityType::UNREGISTERED->value);
            $table->boolean('uses_digital_payment')->default(false);
            $table->enum('digital_platform_type', array_column(DigitalPlatformType::cases(), 'value'))->default(DigitalPlatformType::NONE->value);
            $table->enum('capital_source', array_column(CapitalSource::cases(), 'value'))->default(CapitalSource::PERSONAL->value);
            $table->boolean('is_environmentally_friendly')->default(false);
            $table->enum('bumdes_partnership_status', array_column(BumdesPartnershipStatus::cases(), 'value'))->default(BumdesPartnershipStatus::NONE->value);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msmes');
    }
};
