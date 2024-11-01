@extends('layouts.personal')

@section('content')
<body class="bg-black"> 
    <div class="min-h-screen flex flex-col items-center pt-6 ">
        <h1 class="text-3xl font-bold text-yellow-500 mb-6">Crear un nuevo evento</h1>

        <div class="shadow-md rounded-lg overflow-hidden w-full sm:max-w-md bg-black">
            <form action="{{ route('events.store') }}" method="POST" class="px-8 py-8" id="event-create-form">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-white font-bold mb-2">Nombre del evento:</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-300 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-white font-bold mb-2">Descripción:</label>
                    <textarea name="description" id="description"
                        class="bg-gray-300 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date_start" class="block text-white font-bold mb-2">Fecha de Inicio:</label>
                    <input type="date" name="date_start" id="date_start"
                        class="bg-gray-300 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('date_start') }}" required>
                    @error('date_start')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date_end" class="block text-white  font-bold mb-2">Fecha de Finalización:</label>
                    <input type="date" name="date_end" id="date_end"
                        class="bg-gray-300 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('date_end') }}" required>
                    @error('date_end')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-white  font-bold mb-2">Ubicación:</label>
                    <input type="text" name="location" id="location"
                        class="bg-gray-300 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('location') }}" required>
                    @error('location')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="max_slots" class="block text-white  font-bold mb-2">Número Máximo de Slots:</label>
                    <input type="number" name="max_slots" id="max_slots" min="1"
                        class="bg-gray-300 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('max_slots') }}" required>
                    @error('max_slots')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-white  font-bold mb-2">Estado:</label>
                    <select name="status" id="status"
                        class="bg-gray-300 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" required>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('events.index') }}"
                        class=" text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                    <button type="submit"
                        class=" text-white px-4 py-2 rounded hover:bg-yellow-500">Crear nuevo evento</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</body>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('event-create-form').addEventListener('submit', function(event) {
            event.preventDefault(); 

            Swal.fire({
                title: "¿Quieres agregar este nuevo evento?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `No guardar`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Evento agregado con éxito!", "", "success").then(() => {
                        this.submit(); 
                    });
                } else if (result.isDenied) {
                    Swal.fire("Se cancelo la creacion", "", "info");
                }
            });
        });
    });
</script>
