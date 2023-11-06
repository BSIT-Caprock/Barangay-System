<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasHistory
{
    public function history()
    {
        return $this->hasMany($this->historyModel);
    }

    public static function bootHasHistory()
    {
        static::created(function (Model $model) {
            // Create history entry for the newly created model
            $attributes = array_diff_key($model->getAttributes(), array_flip(['id']));
            $model->history()->create($attributes);
        });

        static::updated(function (Model $model) {
            // TODO insert or update based on date_accomplished
            // Create a history entry capturing the changes
            $attributes = array_diff_key($model->getAttributes(), array_flip(['id']));
            $model->history()->create($attributes);
        });

        static::deleted(function (Model $model) {
            // Create a history entry for the deleted model
            $attributes = array_diff_key($model->getAttributes(), array_flip(['id']));
            $model->history()->create($attributes);
        });

        static::restored(function (Model $model) {
            // TODO Create a history entry for the restored model
            $attributes = array_diff_key($model->getAttributes(), array_flip(['id']));
            $model->history()->create($attributes);
        });
    }
}
