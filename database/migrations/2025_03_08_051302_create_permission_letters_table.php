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
        Schema::create('permission_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('submissions')->onDelete('cascade');
            $table->string('doc_number')->nullable();
            $table->string('service_type');
            $table->string('student_name');
            $table->string('nim');
            $table->string('study_program');
            $table->string('pob');
            $table->date('bod');
            $table->text('address');
            $table->string('thesis_title');
            $table->string('institution_name');
            $table->string('institution_city');
            $table->string('head_of_institution');
            $table->text('research_address');
            $table->date('research_date');
            $table->string('research_object');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_letters');
    }
};
