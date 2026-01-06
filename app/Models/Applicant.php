<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'gender',
        'country',
        'city',
        'educations', //
        'industry',
        'current_position',
        'experiences', //
        'skills', //
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'applicant_id', 'id');
    }

    public function savedJobs(): HasMany
    {
        return $this->hasMany(SavedJob::class, 'applicant_id', 'id');
    }

}
