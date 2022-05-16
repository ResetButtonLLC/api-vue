<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public readonly Model $model;
    public readonly string $action;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $model, string $action)
    {
        $this->model = $model;
        $this->action = $action;
    }


}
