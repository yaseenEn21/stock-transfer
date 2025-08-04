<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'delivery_integration_id' => 'nullable|exists:deliveries,id',
            'warehouse_from_id'       => 'required|exists:warehouses,id|different:warehouse_to_id',
            'warehouse_to_id'         => 'required|exists:warehouses,id',
            'notes'                   => 'nullable|string|max:500',
            'products'                => 'required|array|min:1',
            'products.*.product_id'   => 'required|exists:products,id',
            'products.*.quantity'     => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_from_id.different' => 'The source and destination warehouses must be different.',
            'products.required'           => 'At least one product must be added.',
        ];
    }
}
