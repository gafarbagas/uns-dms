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
        Schema::create('exemption_letter_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exemption_letter_id')->constrained('exemption_letters')->onDelete('cascade');
            $table->string('student_name');
            $table->string('nim');
            $table->string('study_program');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemption_letter_students');
    }
};
