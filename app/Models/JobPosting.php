<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPosting extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'title',
        'description', 
        'experience', 
        'salary',
        'location',
        'company_name', 
        'company_logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function extras()
    {
        return $this->hasMany(JobExtra::class, 'job_posting_id');
    }

    public function skills()
    {
        return $this->hasMany(JobSkill::class, 'job_posting_id');
    }
}
