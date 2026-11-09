<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guestbook_entries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('visit_date');
            $table->string('full_name');
            $table->string('address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('institution')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('purpose');
            $table->text('message')->nullable();
            $table->longText('signature');
            $table->string('status')->default('pending')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guestbook_entries');
    }
};
