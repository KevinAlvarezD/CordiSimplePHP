<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 3 reservas específicas
        Reservation::create([
            'status' => true,
            'user_id' => 1, // Usuario 1
            'event_id' => 3, // Evento 1
        ]);

        Reservation::create([
            'status' => true,
            'user_id' => 2, // Usuario 2
            'event_id' => 4, // Evento 2
        ]);

        Reservation::create([
            'status' => true,
            'user_id' => 4, // Usuario 3
            'event_id' => 5, // Evento 3
        ]);
    }
}
