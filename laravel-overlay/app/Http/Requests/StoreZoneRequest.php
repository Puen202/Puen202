<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreZoneRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('machines.edit') ?? false; }
    public function rules(): array
    {
        return [
            'site_id' => ['required', 'exists:sites,id'],
            'name' => ['required', 'max:120'],
            'code' => ['required', 'max:30'],
            'description' => ['nullable', 'max:500'],
        ];
    }
}
