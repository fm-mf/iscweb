<?php

namespace App\Http\Requests\Partak;

use Illuminate\Foundation\Http\FormRequest;

class ProductSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->routeIs('partak.products.sales.store')) {
            return $this->user()->can('acl', 'productSales.add');
        }

        return false;
    }

    public function rules(): array
    {
        // TODO: proper validation of required fields with/without user
        return [
            'id_user' => ['integer', 'exists:users'],
            'customer_name' => ['string', 'max:255'],
            'customer_email' => ['email', 'max:255'],
            'paid' => ['required', 'integer'],
            'payment_method' => ['required', 'payment_method'],
        ];
    }
}
