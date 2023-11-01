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
            $model->history()->create($model->getAttributes());
        });

        static::updated(function (Model $model) {
            // Check if any changes have occurred
            if ($model->wasChanged()) {
                // Create a history entry capturing the changes
                $model->history()->create($model->getAttributes());
            }
        });

        static::deleted(function (Model $model) {
            // Create a history entry for the deleted model
            $model->history()->create($model->getAttributes());
        });

        static::restored(function (Model $model) {
            // TODO Create a history entry for the restored model
            $model->history()->create($model->getAttributes());
        });
    }
}
