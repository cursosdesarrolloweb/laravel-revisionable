<?php

namespace App\Models;

use App\Traits\Revisionable;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use Revisionable;

    protected $fillable = ['user_id', 'subject', 'priority', 'message'];

    protected array $revisionableColumns = ['subject', 'priority'];
}
