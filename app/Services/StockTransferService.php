<?php
namespace App\Services;

use App\Models\StockTransfer;
use App\Enums\StockTransferStatus;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class StockTransferService
{
    public function changeStatus(StockTransfer $transfer, string $newStatus)
    {
        if (!in_array($newStatus, array_column(StockTransferStatus::cases(), 'value'))) {
            throw new HttpException(422, 'Invalid status provided');
        }

        if (!$this->canChangeStatus(Auth::user(), $transfer->status, $newStatus)) {
            throw new HttpException(403, 'Status change not allowed');
        }

        $transfer->update(['status' => $newStatus]);

        event(new \App\Events\StockTransferStatusChanged($transfer, $newStatus));

        return $transfer->fresh();
    }

    private function canChangeStatusold($user, $current, $new): bool
    {
        $rules = [
            'new' => ['preparing', 'cancelled'],
            'preparing' => ['ready', 'cancelled'],
            'ready' => ['shipping', 'cancelled'],
            'shipping' => ['received'],
            'received' => ['completed', 'returning'],
            'completed' => ['returning'],
        ];

        return in_array($new, $rules[$current] ?? []);
    }

    private function canChangeStatus($user, $current, $new): bool
    {
        $rules = [
            'new' => [
                'preparing' => 'sending_warehouse',
                'cancelled' => 'sending_warehouse',
            ],
            'preparing' => [
                'ready' => 'sending_warehouse',
                'cancelled' => 'sending_warehouse',
            ],
            'ready' => [
                'shipping' => 'sending_warehouse',
                'cancelled' => 'sending_warehouse',
            ],
            'shipping' => [
                'received' => 'shipping_integration', 
            ],
            'received' => [
                'completed' => 'receiving_warehouse',
                'returning' => 'receiving_warehouse',
            ],
            'completed' => [
                'returning' => 'receiving_warehouse',
            ],
        ];

        if (!isset($rules[$current][$new])) {
            return false;
        }

        $requiredRole = $rules[$current][$new];

        return $user->hasRole($requiredRole);
    }

}
