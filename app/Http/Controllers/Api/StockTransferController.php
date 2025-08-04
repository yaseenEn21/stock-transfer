<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StockTransfer;
use App\Services\StockTransferService;
use App\Enums\StockTransferStatus;
use App\Http\Requests\StoreStockTransferRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Resources\StockTransferResource;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{
    protected $service;

    public function __construct(StockTransferService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $transfers = StockTransfer::with(['products', 'createdBy'])
            ->latest()
            ->paginate($perPage);

        return $this->successResponse(
            StockTransferResource::collection($transfers)->response()->getData(true),
            'Stock transfers retrieved successfully'
        );
    }


    public function store(StoreStockTransferRequest $request)
    {
        $user = auth()->user();

        if (!$user->hasRole('sending_warehouse')) {
            return $this->errorResponse('Unauthorized to create stock transfer.', 403);
        }

        $validated = $request->validated();

        $transfer = StockTransfer::create([
            'status' => StockTransferStatus::NEW ->value,
            'delivery_integration_id' => $validated['delivery_integration_id'] ?? null,
            'warehouse_from_id' => $validated['warehouse_from_id'],
            'warehouse_to_id' => $validated['warehouse_to_id'],
            'notes' => $validated['notes'] ?? null,
            'created_by' => auth()->id()
        ]);

        foreach ($validated['products'] as $product) {
            $transfer->products()->create([
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
        }

        $data = $transfer->load('products');

        $transfer->load(['products', 'createdBy']);

        return $this->successResponse(
            new StockTransferResource($transfer),
            'Stock transfer created successfully',
            201
        );

    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $transfer = StockTransfer::findOrFail($id);

            $updated = $this->service->changeStatus($transfer, $request->status);

            return $this->successResponse($updated, 'Status updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Stock transfer not found', 404);
        } catch (HttpException $e) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            return $this->errorResponse('Unexpected error occurred', 500);
        }
    }


    public function show($id)
    {
        try {
            $transfer = StockTransfer::with('products', 'createdBy')->findOrFail($id);

            return $this->successResponse(new StockTransferResource($transfer), 'Transfer Details');
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Stock transfer not found', 404);
        }
    }

    public function cancelOrReturn(Request $request, $id)
    {
        try {
            $transfer = StockTransfer::findOrFail($id);

            $status = $request->status;

            if (!in_array($status, [StockTransferStatus::CANCELLED->value, StockTransferStatus::RETURNING->value])) {
                return $this->errorResponse('The status must be either cancelled or returning', 400);
            }

            $updated = $this->service->changeStatus($transfer, $request->status);

            return $this->successResponse($updated, 'Status updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Stock transfer not found', 404);
        } catch (HttpException $e) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            return $this->errorResponse('Unexpected error occurred', 500);
        }
    }

    public function statusFilter()
    {
        $statuses = array_map(fn($status) => $status->value, StockTransferStatus::cases());

        return $this->successResponse($statuses, 'Available statuses');
    }
}

