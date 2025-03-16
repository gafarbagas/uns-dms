<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExemptionLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'doc_number_1',
        'doc_number_2',
        'doc_number_3',
        'cover_letter_number',
        'cover_letter_date',
        'event_organizer',
        'event_name',
        'event_place',
        'event_level',
        'exemption_date_start',
        'exemption_date_end',
        'exemption_reason',
        'lecture_name',
        'lecture_nidn',
        'lecture_unit',
        'lecture_duty',
        'participation_status',
        'sport_name',
        'attachment',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function students()
    {
        return $this->hasMany(ExemptionLetterStudent::class);
    }
}
