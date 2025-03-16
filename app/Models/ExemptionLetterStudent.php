<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExemptionLetterStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'exemption_letter_id',
        'student_name',
        'nim',
        'study_program',
    ];

    public function exemptionLetter()
    {
        return $this->belongsTo(ExemptionLetter::class);
    }
}
