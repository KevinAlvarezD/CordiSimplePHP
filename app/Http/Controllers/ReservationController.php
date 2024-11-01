<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact("reservations"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservations.create');
    }

    public function store(ReservationRequest $request)
    {
        // Verificar si el usuario está logueado
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['login' => 'Debes estar logueado para hacer una reserva.'])->withInput();
        }
    
        $validatedData = $request->validated();
    
        // Obtener el evento utilizando el ID proporcionado en la solicitud
        $event = Event::find($validatedData['event_id']);
    
        // Verificar si el evento existe y su estado
        if (!$event || $event->status == 0) {
            return redirect()->back()->withErrors(['event_id' => 'El evento no está activo o no existe.'])->withInput();
        }
    
        // Asignar el ID del usuario autenticado en el array
        $validatedData['user_id'] = Auth::id();
        Reservation::create($validatedData);
    
        return redirect()->route('reservations.index')->with('success', 'Reservación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
