<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index',compact("events") );
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
        
        return redirect()->route('events.index')->with('success', 'event created successfully.');
    }


    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact("event") );
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(EventRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $event = Event::findOrFail($id);
        $event->update($validatedData);

        return redirect()->route('events.index')->with('success', 'Evento actualizado exitosamente.');
    }


    public function destroy(string $id)
    {
        $event = Event::find($id);
        $event->delete();
        return redirect()->route("events.index")->with('success', 'Event eliminada con exito.');
    }

}
