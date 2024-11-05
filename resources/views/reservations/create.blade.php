@extends('layouts.personal')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Confirmación de Reserva</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-8 py-8">
                <!-- Mostrar detalles del evento -->
                <div class="mb-4">
                    <p class="text-xl font-semibold text-gray-800 mb-2">Detalles del Evento:</p>
                    <p class="text-gray-700"><strong>Nombre del Evento:</strong> {{ $event->name }}</p>
                    <p class="text-gray-700"><strong>Descripción:</strong> {{ $event->description }}</p>
                    <p class="text-gray-700"><strong>Fecha de inicio:</strong> {{ $event->date_start }}</p>
                    <p class="text-gray-700"><strong>Fecha de finalización:</strong> {{ $event->date_end }}</p>
                    <p class="text-gray-700"><strong>Ubicación:</strong> {{ $event->location }}</p>
                </div>

                <!-- Mostrar detalles de la reserva (usuario) -->
                <div class="mb-4">
                    <p class="text-xl font-semibold text-gray-800 mb-2">Detalles de tu Reserva:</p>
                    <p class="text-gray-700"><strong>Usuario:</strong> {{ $user->name }}</p>
                    <p class="text-gray-700"><strong>Correo:</strong> {{ $user->email }}</p>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('reservations.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                    <form action="{{ route('reservations.store') }}" method="POST" id="create-reservation-form">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Confirmar Reserva
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para mensajes de error de login --}}
    @if ($errors->has('login'))
        <div id="login-error-modal" class="fixed inset-0 flex items-center justify-center z-50"
            style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                <h2 class="text-lg font-bold text-red-700">Error</h2>
                <p class="mt-2 text-gray-700">{{ $errors->first('login') }}</p>
                <div class="mt-4 flex justify-between">
                    <button onclick="document.getElementById('login-error-modal').style.display='none'"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Permanecer sin loguear
                    </button>
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Loguearme
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection
