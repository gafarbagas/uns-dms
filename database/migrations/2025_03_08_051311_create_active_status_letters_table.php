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
        Schema::create('active_status_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('submissions')->onDelete('cascade');
            $table->string('doc_number')->nullable();
            $table->string('student_name');
            $table->string('pob');
            $table->date('bod');
            $table->string('nim');
            $table->text('address');
            $table->string('study_program');
            $table->integer('year');
            $table->integer('semester');
            $table->string('institution_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_status_letters');
    }
};
