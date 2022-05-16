<?php

namespace App\Observers;

use App\Events\ModelLogEvent;
use Illuminate\Database\Eloquent\Model;

class ModelObserver
{
    public function created(Model $model)
    {
        ModelLogEvent::dispatch($model, 'created');
    }

    public function updated(Model $model)
    {
        ModelLogEvent::dispatch($model, 'updated');
    }

    public function deleted(Model $model)
    {
        ModelLogEvent::dispatch($model, 'deleted');
    }
}
