<?php
namespace App\Enums;

enum StockTransferStatus: string
{
    case NEW = 'new';
    case PREPARING = 'preparing';
    case READY = 'ready';
    case SHIPPING = 'shipping';
    case RECEIVED = 'received';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case RETURNING = 'returning';
}
