<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveStatusLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'doc_number',
        'student_name',
        'pob',
        'bod',
        'nim',
        'address',
        'study_program',
        'year',
        'semester',
        'institution_name',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
