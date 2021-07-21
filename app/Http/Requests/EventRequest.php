<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->routeIs('partak.events.store')) {
            return $this->user()->can('acl', 'events.add');
        } elseif ($this->routeIs('partak.events.update')) {
            return $this->user()->can('acl', 'events.edit');
        }

        return false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'id_semester' => ['required', 'exists:semesters'],
            'location' => ['nullable', 'string', 'max:255'],
            'location_url' => ['nullable', 'string', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'string', 'url', 'max:255'],
            'visible_date' => ['required', 'date_format:d M Y'],
            'visible_time' => ['required', 'date_format:g:i A'],
            'start_date' => ['required', 'date_format:d M Y'],
            'start_time' => ['required', 'date_format:g:i A'],
            'description' => ['required', 'string'],
            'cover' => ['nullable', 'file', 'image', 'max:307400', 'mimes:jpg,jpeg,png'],
        ];
    }
}
