<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Entry extends Model
{
    protected $fillable=[
        'user_id',
        'job_id',
        'entry_date',
        'hours',
        'description',
    ];

    public function job():HasOne
    {
        return $this->hasOne(JobCode::class, 'id','job_id');
    }

    public function approvals():HasMany
    {
        return $this->hasMany(Approval::class, 'entry_id','id');
    }
}
