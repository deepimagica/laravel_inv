<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'billed_name' => 'required|string',
            'billed_address' => 'required|string',
            'billed_phone' => 'required|string',
            'shipped_name' => 'required|string',
            'shipped_address' => 'required|string',
            'shipped_phone' => 'required|string',
            'items' => 'required|array|min:1',
            'tax' => 'nullable|numeric|min:0',
        ];

        foreach ($this->input('items', []) as $index => $item) {
            if (
                !empty($item['product']) ||
                !empty($item['hsn']) ||
                !empty($item['design']) ||
                !empty($item['quantity']) ||
                !empty($item['rate']) ||
                !empty($item['amount'])
            ) {
                $rules["items.$index.product"]  = 'required|string';
                $rules["items.$index.hsn"]      = 'required|string';
                $rules["items.$index.design"]   = 'required|string';
                $rules["items.$index.quantity"] = 'required|integer|min:1';
                $rules["items.$index.rate"]     = 'required|numeric|min:0.01';
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'items.required'             => 'At least one invoice item should be required in invoice',
            'items.*.product.required'   => 'Product name is required.',
            'items.*.hsn.required'       => 'HSN code is required.',
            'items.*.design.required'    => 'Design is required.',
            'items.*.quantity.required'  => 'Quantity is required.',
            'items.*.quantity.min'       => 'Quantity must be at least 1.',
            'items.*.rate.required'      => 'Rate is required.',
            'items.*.rate.min'           => 'Rate must be at least 0.01.',
        ];
    }
}
