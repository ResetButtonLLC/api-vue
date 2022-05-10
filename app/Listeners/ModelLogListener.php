<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ModelLogEvent;
use Illuminate\Support\Facades\Log;

class ModelLogListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ModelLogEvent  $event
     * @return void
     */
    public function handle(ModelLogEvent $event)
    {
        Log::build([
            'driver' => 'daily',
            'path' => storage_path('logs/'.$event->model->getTable().'.log'),
        ])->info($event->action);
    }
}
