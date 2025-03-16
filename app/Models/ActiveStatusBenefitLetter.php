<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveStatusBenefitLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'doc_number',
        'student_name',
        'nim',
        'study_program',
        'tingkat',
        'semester',
        'parent_name',
        'nip',
        'rank',
        'group',
        'room',
        'institution_name',
        'marital_status',
        'retirement_payment_book_number',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
