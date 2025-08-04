<?php

namespace App\Listeners;

use App\Events\StockTransferStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendStatusNotification
{
    public function handle(StockTransferStatusChanged $event) {
        Log::info("Status changed for Transfer {$event->transfer->id} to {$event->status}");
    }
}
