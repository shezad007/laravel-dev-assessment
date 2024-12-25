<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;

    protected $table = 'job_skill';

    protected $fillable = [
        'job_posting_id',
        'skill',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'job_posting_id');
    }
}
