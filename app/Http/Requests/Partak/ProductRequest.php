<?php

namespace App\Http\Requests\Partak;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->routeIs('partak.products.store')) {
            return $this->user()->can('acl', 'products.add');
        } elseif ($this->routeIs('partak.products.update')) {
            return $this->user()->can('acl', 'products.edit');
        }

        return false;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'sold_out' => ['nullable', 'boolean'],
            'image' => ['file', 'image', 'max:307400', 'mimes:jpg,jpeg,png']
        ];

        if ($this->routeIs('partak.products.update')) {
            $rules['image'][] = ['nullable'];
        } else {
            $rules['image'][] = ['required'];
        }

        return $rules;
    }
}
