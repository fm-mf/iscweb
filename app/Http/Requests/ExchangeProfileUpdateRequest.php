<?php

namespace App\Http\Requests;

use App\Models\Arrival;
use Illuminate\Foundation\Http\FormRequest;

class ExchangeProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $fbProfileUrlRegex = '/^(https?:\/\/)?((www|m)\.)?(facebook|fb)(\.(com|me))\/(profile\.php\?id=[0-9]+(&[^&]*)*|(?!profile\.php\?)([a-zA-Z0-9][.]*){4,}[a-zA-Z0-9]+\/?(\?.*)?)$/';
        $instagramRegex = '/^([A-Za-z0-9_](?:(?:[A-Za-z0-9_]|(?:\.(?!\.))){0,28}(?:[A-Za-z0-9_]))?)$/';

        return [
            'arrival_skipped' => ['nullable', 'boolean'],
            'arrival_date' => ['required_unless:arrival_skipped,1,opt_out,1', 'nullable', 'date_format:' . Arrival::FORM_DATE_FORMAT],
            'arrival_time' => ['required_unless:arrival_skipped,1,opt_out,1', 'nullable', 'date_format:' . Arrival::FORM_TIME_FORMAT],
            'transportation' => ['required_unless:arrival_skipped,1,opt_out,1', 'nullable', 'exists:transportation,id_transportation'],
            'accommodation' => ['required', 'exists:accommodation,id_accommodation'],
            'about' => ['nullable', 'string', 'max:16383'],
            'whatsapp' => ['nullable', 'phone:AUTO'],
            'facebook' => ['nullable', "regex:$fbProfileUrlRegex"],
            'instagram' => ['nullable', "regex:$instagramRegex"],
            'willing_to_present' => ['nullable', 'boolean'],
            'opt_out' => ['nullable', 'boolean'],
            'privacy_policy' => ['accepted'],
        ];
    }
}
