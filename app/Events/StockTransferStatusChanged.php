<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\StockTransfer;

class StockTransferStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transfer;
    public $status;

    public function __construct(StockTransfer $transfer, $status) {
        $this->transfer = $transfer;
        $this->status = $status;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('stock-transfer'),
        ];
    }
}
