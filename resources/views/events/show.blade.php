@extends('layouts.personal')

@section('content')

    <body class="bg-black">
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-bold text-center text-yellow-500 mb-6">Detalles del evento: {{ $event->id }}</h1>

            <div class=" shadow-md rounded-lg overflow-hidden">
                <div class="px-8 py-6">

                    <div class="mb-4">
                        <h2 class="text-2xl font-bold text-gray-400 mb-2">Nombre del evento:</h2>
                        <p class="text-white text-lg capitalize">{{ $event->name }}</p>
                    </div>


                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Descripción:</h3>
                        <p class="text-white text-lg">{{ ucfirst($event->description) }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Fecha de inicio:</h3>
                        <p class="text-white text-lg">{{ $event->date_start }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Fecha de finalización:</h3>
                        <p class="text-white text-lg">{{ $event->date_end }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Ubicación:</h3>
                        <p class="text-white text-lg capitalize">{{ $event->location }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Capacidad máxima:</h3>
                        <p class="text-white text-lg">{{ $event->max_slots }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Estado</h3>
                        <p class="text-white text-lg capitalize">{{ $event->status ? 'activo' : 'inactivo' }} </p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Creada el:</h3>
                        <p class="text-white text-lg">{{ $event->created_at->format('d-m-Y H:i:s') }}</p>
                    </div>


                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Última actualización:</h3>
                        <p class="text-white text-lg">{{ $event->updated_at->diffForHumans() }}</p>
                    </div>


                    <div class="flex justify-end mt-6">
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
                        @endif

                        <div class="inline-block ml-4 mt-2"> 
                            <a href="{{ route('events.index') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Volver a la
                                lista</a>
                        
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('delete').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío inmediato del formulario

            Swal.fire({
                title: "¿Estás seguro que quieres eliminar el evento?",
                showDenyButton: true,
                confirmButtonText: "Eliminar",
                denyButtonText: `Cancelar`,
                confirmButtonColor: "#d33",
                denyButtonColor: "#3085d6",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mensaje de éxito y luego enviar el formulario
                    Swal.fire("Evento eliminado con éxito!").then(() => {
                        this.submit(); // Enviar el formulario
                    });
                }
            });
        });
    });
</script>
