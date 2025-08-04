<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $products = Product::select('id', 'name')->paginate($perPage);

        return $this->successResponse($products, 'Products List');

    }
}
