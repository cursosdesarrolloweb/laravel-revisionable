<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Revision extends Model
{
    protected $fillable = [
        'owner_id',
        'owner_type',
        'revisionable_id',
        'revisionable_type',
        'column_name',
        'old_value',
        'new_value',
        'comments',
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function revisionable(): MorphTo
    {
        return $this->morphTo();
    }
}
