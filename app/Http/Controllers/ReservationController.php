<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function index()
    {
        // Verificar si el usuario está logueado
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['login' => 'Debes estar logueado para hacer una reserva.'])->withInput();
        }
    
        // Obtener el usuario logueado
        $user = Auth::user();
    
        // Si el usuario es administrador, obtener todas las reservas
        if ($user->rols_id == 1 ) {
            $reservations = Reservation::all();
        } else {
            // Si el usuario no es administrador, obtener solo las reservas relacionadas con el usuario logueado
            $reservations = Reservation::where('user_id', $user->id)->get();
        }
    
        // Pasar las reservas a la vista
        return view('reservations.index', compact('reservations'));
    }


    public function create($event_id)
    {
        // Buscar el evento usando el ID pasado
        $event = Event::findOrFail($event_id);

        // Obtener el usuario logueado
        $user = Auth::user();

        // Pasar el evento y el usuario a la vista
        return view('reservations.create', compact('event', 'user'));
    }

    public function store(Request $request)
    {
        /*   if (!Auth::check()) {
            return redirect()->back()->withErrors(['login' => 'Debes estar logueado para hacer una reserva.'])->withInput();
            
        }

    
        $validatedData = $request->validated();
    
        
        $event = Event::find($validatedData['event_id']);
    
        if (!$event || $event->status == 0) {
            return redirect()->back()->withErrors(['event_id' => 'El evento no está activo o no existe.'])->withInput();
        }
    
        $validatedData['user_id'] = Auth::id();
        Reservation::create($validatedData);
    
        return redirect()->route('reservations.index')->with('success', 'Reservación creada exitosamente.'); */

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Crear una nueva reserva
        Reservation::create([
            'event_id' => $validated['event_id'],
            'user_id' => $validated['user_id'],
            'status' => 1, // o el valor por defecto que necesites
        ]);

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->route('reservations.index')->with('success', 'Reserva confirmada exitosamente.');
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
