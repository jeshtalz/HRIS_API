<?php

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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->string('position_title');
            $table->string('department');
            $table->string('monthly_salary');
            $table->string('salary');
            $table->string('status_appointment');
            $table->string('government_service');
            $table->date('inclusive_dates_from');
            $table->date('inclusive_dates_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
