<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Entry extends Model
{

    protected $fillable = [
        'user_id',
        'job_id',
        'entry_date',
        'hours',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'job_id' => 'integer',
            'entry_date' => 'date',
            'hours' => 'float',
        ];
    }

    /**
     * Get the user associated with the Entry
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the user associated with the Entry
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function job(): HasOne
    {
        return $this->hasOne(JobCode::class, 'id', 'job_id');
    }

    /**
     * Get all of the approvals for the Entry
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvals(): HasMany
    {
        return $this->hasMany(Approval::class, 'entry_id', 'id');
    }

    public function myApproval() {
        return $this->approvals()->where('user_id', Auth::user()->id);
    }
}
