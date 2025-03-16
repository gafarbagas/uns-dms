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
        Schema::create('exemption_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('submissions')->onDelete('cascade');
            $table->date('cover_letter_date');
            $table->date('exemption_date_start');
            $table->date('exemption_date_end');
            $table->string('attachment');
            $table->string('cover_letter_number');
            $table->string('doc_number_1')->nullable();
            $table->string('doc_number_2')->nullable();
            $table->string('doc_number_3')->nullable();
            $table->string('event_level');
            $table->string('event_name');
            $table->string('event_organizer');
            $table->string('event_place');
            $table->string('exemption_reason');
            $table->string('lecture_name');
            $table->string('lecture_nidn');
            $table->string('lecture_unit');
            $table->string('lecture_duty');
            $table->string('participation_status');
            $table->string('sport_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemption_letters');
    }
};
