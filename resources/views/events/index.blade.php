@extends('layouts.personal')

@section('content')

    <body class="bg-black">
        <h1 class="text-3xl font-bold text-center text-yellow-500 mb-6">Lista de Eventos</h1>

        <div class="flex justify-center mb-4">
            <a href="{{ route('events.create') }}" class="p-3 text-white rounded hover:bg-yellow-500">Nuevo evento</a>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
            @forelse($events as $event)
                <div class="shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-bold text-yellow-500">{{ $event->name }}</h2>
                    <p class="text-white">{{ ucfirst($event->description) }}</p>
                    <p class="text-gray-500">Fecha de inicio: <span class="text-white">{{ $event->date_start }}</span></p>
                    <p class="text-gray-500">Fecha de finalización: <span class="text-white">{{ $event->date_end }}</span>
                    </p>
                    <p class="text-gray-500">Ubicación: <span class="text-white">{{ $event->location }}</span></p>
                    <p class="text-gray-500">Capacidad: <span class="text-white">{{ $event->max_slots }}</span></p>
                    <p class="text-gray-500">Estado: <span
                            class="text-white">{{ $event->status ? 'activo' : 'inactivo' }}</span></p>

                    <div class="mt-4 flex justify-between">
                        @if (Auth::user()->rol->name == 'administrator')
                        <div>
                            <a href="{{ route('events.edit', $event->id) }}"
                                class="text-gray-500 hover:bg-yellow-500 hover:text-white p-2 rounded">Editar</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block"
                                data-event-id="{{ $event->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:bg-red-500 hover:text-white p-2 rounded">Eliminar</button>
                            </form>
                        </div>
                            
                        @elseif (Auth::user()->rol->name == 'general user')
                        <div>
                            <a href="{{ route('reservations.create', ['event_id' => $event->id]) }}"
                                class="bg-violet-500 px-3 py-2 text-white rounded hover:bg-violet-600">
                                Reservar
                            </a>
                        </div>
                        @endif




                        <a href="{{ route('events.show', $event->id) }}"
                            class="text-gray-500 text-1.5xl hover:bg-blue-600 hover:text-white p-2 rounded">Detalles</a>

                    </div>
                </div>
            @empty
                <div class="col-span-1 text-center text-gray-500">No hay eventos disponibles.</div>
            @endforelse
        </div>
    @endsection
</body>





<script>
    document.addEventListener('DOMContentLoaded', function() {
     
        const deleteForms = document.querySelectorAll('.event-delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); 

                const eventId = this.getAttribute('data-event-id');
                Swal.fire({
                    title: "¿Estás seguro que quieres eliminar el evento " + eventId +
                        "?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Eliminado!",
                            icon: "success"
                        });
                        this.submit();
                    }
                });
            });
        });
    });
</script>
