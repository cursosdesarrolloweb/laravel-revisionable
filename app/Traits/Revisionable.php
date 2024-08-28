<?php

namespace App\Traits;

use App\Models\Revision;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Revisionable
{
    public function revisions(): MorphMany
    {
        return $this->morphMany(Revision::class, 'revisionable');
    }

    public static function bootRevisionable(): void
    {
        static::created(function ($model)
        {
            foreach ($model->revisionableColumns as $column) {
                $model->revisions()->create([
                    'owner_id' => auth()->id(),
                    'owner_type' => get_class(auth()->user()),
                    'revisionable_id' => $model->id,
                    'revisionable_type' => get_class($model),
                    'column_name' => $column,
                    'old_value' => null,
                    'new_value' => $model->{$column},
                    'comments' => 'Created',
                ]);
            }
        });

        static::updated(function ($model)
        {
            foreach ($model->revisionableColumns as $column) {
                if ($model->isDirty($column)) {
                    $model->revisions()->create([
                        'owner_id' => auth()->id(),
                        'owner_type' => get_class(auth()->user()),
                        'revisionable_id' => $model->id,
                        'revisionable_type' => get_class($model),
                        'column_name' => $column,
                        'old_value' => $model->getOriginal($column),
                        'new_value' => $model->{$column},
                        'comments' => 'Updated',
                    ]);
                }
            }
        });

        static::deleted(function ($model) {
            foreach ($model->revisionableColumns as $column) {
                $model->revisions()->create([
                    'owner_id' => auth()->id(),
                    'owner_type' => get_class(auth()->user()),
                    'revisionable_id' => $model->id,
                    'revisionable_type' => get_class($model),
                    'column_name' => $column,
                    'old_value' => $model->{$column},
                    'new_value' => null,
                    'comments' => 'Deleted',
                ]);
            }
        });
    }
}
