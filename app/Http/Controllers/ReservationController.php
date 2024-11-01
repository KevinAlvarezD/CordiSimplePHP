<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
   
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact("reservations"));
    }

  
    public function create()
    {
        return view('reservations.create');
    }

    public function store(ReservationRequest $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['login' => 'Debes estar logueado para hacer una reserva.'])->withInput();
        }
    
        $validatedData = $request->validated();
    
        
        $event = Event::find($validatedData['event_id']);
    
        if (!$event || $event->status == 0) {
            return redirect()->back()->withErrors(['event_id' => 'El evento no está activo o no existe.'])->withInput();
        }
    
        $validatedData['user_id'] = Auth::id();
        Reservation::create($validatedData);
    
        return redirect()->route('reservations.index')->with('success', 'Reservación creada exitosamente.');
    }

    public function show(string $id)
    {
        //
    }

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
