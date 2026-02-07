<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMachineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('machines.create') ?? false;
    }

    public function rules(): array
    {
        return [
            'site_id' => ['required', 'exists:sites,id'],
            'zone_id' => ['required', 'exists:zones,id'],
            'name' => ['required', 'max:120'],
            'hostname' => ['nullable', 'max:190'],
            'ip' => ['required', 'ip', 'unique:machines,ip'],
            'mac' => ['nullable', 'max:30'],
            'type' => ['required', 'max:50'],
            'vendor' => ['nullable', 'max:100'],
            'model' => ['nullable', 'max:100'],
            'os' => ['nullable', 'max:100'],
            'department' => ['required', 'max:100'],
            'status' => ['required', 'in:activo,fuera_servicio,reserva,desconocido'],
            'criticality' => ['required', 'in:baja,media,alta'],
            'notes' => ['nullable', 'max:3000'],
            'cannot_move' => ['nullable', 'boolean'],
            'ip_locked_reason' => ['nullable', 'max:255'],
        ];
    }
}
