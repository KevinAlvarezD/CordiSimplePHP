<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Concierto de Rock',
                'description' => 'Un gran concierto de rock con bandas locales e internacionales.',
                'date_start' => '2024-11-15 18:00:00',
                'date_end' => '2024-11-15 23:00:00',
                'location' => 'Estadio El Campín, Bogotá',
                'max_slots' => 500,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'Feria de Emprendedores',
                'description' => 'Un evento para apoyar a emprendedores locales con exhibiciones y charlas.',
                'date_start' => '2024-10-28 10:00:00',
                'date_end' => '2024-10-30 18:00:00',
                'location' => 'Centro de Convenciones, Medellín',
                'max_slots' => 300,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'Maratón de Cine Clásico',
                'description' => 'Proyecciones de películas clásicas de todos los tiempos.',
                'date_start' => '2024-12-05 14:00:00',
                'date_end' => '2024-12-05 23:00:00',
                'location' => 'Cine Colombia, Cali',
                'max_slots' => 200,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'Festival Gastronómico Internacional',
                'description' => 'Un encuentro culinario con chefs de todo el mundo.',
                'date_start' => '2024-11-25 11:00:00',
                'date_end' => '2024-11-28 20:00:00',
                'location' => 'Centro de Exposiciones, Cartagena',
                'max_slots' => 400,
                'occupied_slots' => 0,
                'status' => false,
            ],
            [
                'name' => 'Concierto de Año Nuevo',
                'description' => 'Celebra el año nuevo con música en vivo y fuegos artificiales.',
                'date_start' => '2024-12-31 20:00:00',
                'date_end' => '2025-01-01 01:00:00',
                'location' => 'Parque de la 93, Bogotá',
                'max_slots' => 1000,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'Exposición de Fotografía Contemporánea',
                'description' => 'Una muestra de fotógrafos emergentes de Colombia.',
                'date_start' => '2024-11-12 10:00:00',
                'date_end' => '2024-11-20 18:00:00',
                'location' => 'Museo de Arte Moderno, Bogotá',
                'max_slots' => 150,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'Convención de Videojuegos',
                'description' => 'Un evento para los amantes de los videojuegos con torneos y charlas.',
                'date_start' => '2024-12-08 09:00:00',
                'date_end' => '2024-12-10 20:00:00',
                'location' => 'Centro de Convenciones, Medellín',
                'max_slots' => 600,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'Taller de Arte Urbano',
                'description' => 'Un taller interactivo sobre técnicas de arte urbano.',
                'date_start' => '2024-11-02 14:00:00',
                'date_end' => '2024-11-02 18:00:00',
                'location' => 'Plaza de Bolívar, Bogotá',
                'max_slots' => 50,
                'occupied_slots' => 0,
                'status' => false,
            ],
            [
                'name' => 'Festival de Música Electrónica',
                'description' => 'Un evento con los mejores DJs del país y del mundo.',
                'date_start' => '2024-11-30 16:00:00',
                'date_end' => '2024-12-01 06:00:00',
                'location' => 'Parque Simón Bolívar, Bogotá',
                'max_slots' => 750,
                'occupied_slots' => 0,
                'status' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate(
                ['name' => $event['name']],
                [
                    'description' => $event['description'],
                    'date_start' => $event['date_start'],
                    'date_end' => $event['date_end'],
                    'location' => $event['location'],
                    'max_slots' => $event['max_slots'],
                    'occupied_slots' => $event['occupied_slots'],
                    'status' => $event['status']
                ]
            );
        }
    }
}

