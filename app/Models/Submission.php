<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doc_type',
        'status',
        'notes',
    ];

    public function ActiveStatusLetter()
    {
        return $this->hasOne(ActiveStatusLetter::class);
    }

    public function ActiveStatusBenefitLetter()
    {
        return $this->hasOne(ActiveStatusBenefitLetter::class);
    }

    public function ExemptionLetter()
    {
        return $this->hasOne(ExemptionLetter::class);
    }

    public function PermissionLetter()
    {
        return $this->hasOne(PermissionLetter::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
