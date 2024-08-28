<?php

namespace App\Models;

use App\Traits\Revisionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Revisionable;

    protected $fillable = ['user_id', 'title', 'content'];

    protected array $revisionableColumns = ['title', 'content'];
}
