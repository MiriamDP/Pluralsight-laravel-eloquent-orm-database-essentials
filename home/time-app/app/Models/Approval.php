<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Approval extends Model
{
    protected $fillable = [
        'entry_id',
        'user_id',
    ];

    public function approver(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function myApprovals()
    {
        return $this->where('user_id', Auth::user()->id);
    }
}
