<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ModelHistoryObserver
{
    public function created(Model $model)
    {
        $this->createHistory($model);
    }

    public function updated(Model $model)
    {
        $this->createHistory($model);
    }

    protected function getHistoryAttributes(Model $model)
    {
        return array_diff_key($model->getAttributes(), array_flip(['id']));
    }

    protected function createHistory(Model $model)
    {
        return $model->history()->create($this->getHistoryAttributes($model));
    }
}
