<?php

use App\Enums\BusinessCategory;
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
            $table->decimal('mothly_revenue', 15, 2)->nullable();

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
