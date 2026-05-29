<?php

use App\Enums\MeasurementMethod;
use App\Enums\StuntingStatus;
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
        Schema::create('child_growth_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('citizen_id')->constrained('citizens')->cascadeOnDelete();

            $table->date('measured_at');
            $table->decimal('weight', 5, 2);
            $table->decimal('height', 5, 2);
            $table->enum('measurement_method', array_column(MeasurementMethod::cases(), 'value'))->default(MeasurementMethod::RECUMBENT->value);
            $table->boolean('vit_a_received')->default(false);
            $table->enum('stunting_status', array_column(StuntingStatus::cases(), 'value'))->nullable();
            $table->foreignUuid('recorded_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_growth_logs');
    }
};
