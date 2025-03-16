<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'doc_number',
        'service_type',
        'student_name',
        'nim',
        'study_program',
        'pob',
        'bod',
        'address',
        'thesis_title',
        'institution_name',
        'institution_city',
        'head_of_institution',
        'research_address',
        'research_date',
        'research_object',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
