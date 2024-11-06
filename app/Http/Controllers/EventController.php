<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Models\Reservation; // Asegúrate de tener este modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Para registrar si no hay usuarios notificados
use App\Notifications\EventCancelledNotification; // Importa la notificación

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact("events"));
    }

    public function create()
    {
        return view('events.create');
    }

    public function Store(EventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['occupied_slots'] = 0;
        Event::create($validatedData);
        
        return redirect()->route('events.index')->with('success', 'Evento creado exitosamente.');
    }

    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact("event"));
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(EventUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $event = Event::findOrFail($id);
        $event->update($validatedData);

        return redirect()->route('events.index')->with('success', 'Evento actualizado exitosamente.');
    }

    /**
     * Cancelar un evento y notificar a los usuarios.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Buscar el evento
        $event = Event::findOrFail($id);

        // Marcar el evento como cancelado (status false o cualquier valor que uses)
        $event->status = false;  // Asegúrate de tener un campo "status" en tu modelo
        $event->save(); // Guardar el cambio

        // Buscar todas las reservas asociadas a este evento
        $reservations = Reservation::where('event_id', $event->id)->get();


        // Contador de usuarios notificados
        $usersNotified = 0;

        // Notificar a los usuarios
        foreach ($reservations as $reservation) {
            if ($reservation->user) { // Enviar la notificación
                $reservation->user->notify(new EventCancelledNotification($event));
                $usersNotified++;
            }
        }

        // Si no se notificaron usuarios, registrar en el log
        if ($usersNotified === 0) {
            Log::info("No hay usuarios suscritos al evento con ID {$event->id}.");
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('events.index')->with('success', 'Evento cancelado y usuarios notificados.');
    }
}
