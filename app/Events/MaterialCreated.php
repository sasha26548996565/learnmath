<?php

namespace App\Events;

use App\Models\Material;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MaterialCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public readonly Material $material;

    public function __construct(Material $material)
    {
        $this->material = $material;
    }
}
