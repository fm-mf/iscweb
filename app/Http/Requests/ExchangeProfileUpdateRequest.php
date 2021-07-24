<?php

namespace App\Http\Requests;

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
            'date' => 'required_without_all:arrival_skipped,opt_out|date_format:d M Y',
            'time' => 'date_format:g:i A',
            'transportation' => 'required_without_all:arrival_skipped,opt_out',
            'privacy_policy' => 'accepted',
            'accommodation' => ['required', 'exists:accommodation,id_accommodation'],
            'whatsapp' => ['phone:AUTO', 'nullable'],
            'facebook' => ["regex:$fbProfileUrlRegex", 'nullable'],
            'instagram' => ["regex:$instagramRegex", 'nullable']
        ];
    }
}
