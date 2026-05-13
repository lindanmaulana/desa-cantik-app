<?php

use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
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
        Schema::create('citizens', function(Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('family_id')->nullable()->constrained('families')->onDelete('set null');
            $table->string('id_number', 16);
            $table->string('full_name', 255);
            $table->enum('family_role', array_column(FamilyRole::cases(), 'value'));
            $table->enum('gender', array_column(Gender::cases(), 'value'))->default(Gender::MALE->value);
            $table->string('birth_place', 100);
            $table->date('birth_date')->nullable();
            $table->enum('religion', array_column(Religion::cases(), 'value'))->default(Religion::OTHER->value);
            $table->enum('marital_status', array_column(MaritalStatus::cases(), 'value'))->default(MaritalStatus::SINGLE->value);
            $table->string('blood_type', 5)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
