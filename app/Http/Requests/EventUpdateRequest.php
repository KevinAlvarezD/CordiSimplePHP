<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'date_start' => 'required|date|after:now',
            'date_end' => 'required|date|after:date_start',
            'location' => 'required|string|max:255',
            'max_slots' => 'required|integer|min:1',
            'status' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del evento es obligatorio.',
            'date_start.after' => 'La fecha de inicio debe ser futura.',
            'date_end.after' => 'La fecha de finalización debe ser después de la fecha de inicio.',
            'max_slots.min' => 'El número máximo de lugares debe ser al menos 1.',
            'status.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }
}
