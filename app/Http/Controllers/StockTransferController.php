<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StockTransfer;
use App\Enums\StockTransferStatus;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
class StockTransferController extends Controller
{



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = StockTransfer::with([
                'warehouseFrom:id,name',
                'warehouseTo:id,name',
                'creator:id,name'
            ])->latest();

            if ($request->has('with_products_count')) {
                $query->withCount('products');
            }

            return DataTables::of($query)
                ->addColumn('from', fn($row) => $row->warehouseFrom->name ?? '-')
                ->addColumn('to', fn($row) => $row->warehouseTo->name ?? '-')
                ->addColumn('creator', fn($row) => $row->creator->name ?? '-')
                ->addColumn('status', fn($row) => "<span class='badge bg-info'>{$row->status}</span>")
                ->rawColumns(['status'])
                ->make(true);
        }

        $statusCounts = StockTransfer::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return view('stock.index', [
            'statusCounts' => $statusCounts,
            'statusOptions' => StockTransferStatus::cases()
        ]);
    }




}