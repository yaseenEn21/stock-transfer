<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $warehouses = Warehouse::select('id', 'name')->paginate($perPage);

        return $this->successResponse($warehouses, 'Warehouses list retrieved successfully');
    }

}
