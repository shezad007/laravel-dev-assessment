<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobExtra extends Model
{
    use HasFactory;

    protected $table = 'job_extra';

    protected $fillable = [
        'job_posting_id',
        'extra',
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
