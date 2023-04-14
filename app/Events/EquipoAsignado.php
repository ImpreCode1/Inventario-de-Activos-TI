<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\CpuEquipo;

class EquipoAsignado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $equipo;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CpuEquipo $equipo)
    {
        $this->equipo = $equipo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
