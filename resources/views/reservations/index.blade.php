@extends('layouts.personal')

@section('content')

<body class="bg-black">
    <h1 class="text-3xl font-bold text-center text-yellow-500 mb-6">Lista de reservas</h1>

    {{-- Mostrar el mensaje de error de login si existe --}}
    @if ($errors->has('login'))
        <div class="max-w-7xl mx-auto mb-4 p-4 bg-red-500 text-white rounded-lg shadow-md flex items-center justify-between">
            <p class="text-lg font-semibold">{{ $errors->first('login') }}</p>
            <button onclick="this.parentElement.style.display='none'" class="text-xl font-bold">&times;</button>
        </div>
    @endif

    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
        {{-- Aquí ya estamos recorriendo las reservas filtradas --}}
        @forelse($reservations as $reservation)
            <div class="shadow-md rounded-lg p-4 mb-6">
                <!-- Mostrar detalles de la reserva -->
                <h2 class="text-lg font-bold text-yellow-500">{{ $reservation->event->name }}</h2>
                <p class="text-white">{{ ucfirst($reservation->event->description) }}</p>
                <p class="text-gray-500">Fecha de inicio: <span class="text-white">{{ $reservation->event->date_start }}</span></p>
                <p class="text-gray-500">Fecha de finalización: <span class="text-white">{{ $reservation->event->date_end }}</span></p>
                <p class="text-gray-500">Ubicación: <span class="text-white">{{ $reservation->event->location }}</span></p>
                <p class="text-gray-500">Capacidad: <span class="text-white">{{ $reservation->event->max_slots }}</span></p>
                <p class="text-gray-500">Estado: <span class="text-white">{{ $reservation->event->status ? 'activo' : 'inactivo' }}</span></p>
                <p class="text-gray-500">Tu estado de reserva: <span class="text-white">{{ $reservation->status ? 'Confirmado' : 'Pendiente' }}</span></p>

                {{-- Mostrar el botón de cancelar solo si es el propietario de la reserva o si es admin --}}
                @if (auth()->user()->rols_id == 1 || auth()->user()->id === $reservation->user_id)
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white px-4 py-2 rounded bg-red-500 hover:bg-red-600">
                            Cancelar Reserva
                        </button>
                    </form>
                @endif
            </div>
        @empty
        <div class="flex items-center justify-center h-full text-center text-gray-500">No tienes reservas realizadas.</div>
        @endforelse
    </div>

</body>
@endsection
