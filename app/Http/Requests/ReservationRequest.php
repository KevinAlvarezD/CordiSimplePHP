<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * 
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer|exists:reservations,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'event_id' => 'required|integer|exists:events,id',
            'status' => 'required|boolean',
            'created_at' => 'nullable|date',
            'modified_at' => 'nullable|date|after_or_equal:created_at',
        ];
    }
    
    public function messages()
    {
        return [
            'id.integer' => 'El ID debe ser un número entero.',
            'id.exists' => 'El ID no existe en la base de datos.',
            'user_id.integer' => 'El ID del usuario debe ser un número entero.',
            'user_id.exists' => 'El usuario no existe en la base de datos.',
            'event_id.required' => 'El ID del evento es obligatorio.',
            'event_id.integer' => 'El ID del evento debe ser un número entero.',
            'event_id.exists' => 'El evento no existe en la base de datos.',
            'status.required' => 'El estado es obligatorio.',
            'status.boolean' => 'El estado debe ser verdadero o falso.',
            'created_at.date' => 'La fecha de creación debe ser una fecha válida.',
            'modified_at.date' => 'La fecha de modificación debe ser una fecha válida.',
            'modified_at.after_or_equal' => 'La fecha de modificación debe ser posterior o igual a la fecha de creación.',
        ];
    }

}
