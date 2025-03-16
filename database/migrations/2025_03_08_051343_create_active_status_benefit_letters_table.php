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
        Schema::create('active_status_benefit_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('submissions')->onDelete('cascade');
            $table->string('doc_number')->nullable();
            $table->string('student_name');
            $table->string('nim');
            $table->string('study_program');
            $table->integer('tingkat');
            $table->integer('semester');
            $table->string('parent_name');
            $table->string('nip');
            $table->string('rank');
            $table->string('group');
            $table->string('room');
            $table->string('institution_name');
            $table->string('marital_status');
            $table->string('retirement_payment_book_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_status_benefit_letters');
    }
};
