<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rols = [
            [
                'name' => 'administrator',
                'description' => 'User  with full access to the system',
            ],
            [
                'name' => 'general user',
                'description' => 'User  with limited access to the system',
            ]
            ];


        foreach ($rols as $rol) {
            Rol::firstOrCreate(
                ['name' => $rol['name']],
                [
                    'description' => $rol['description'],
                ]
            );
        }
    }
}
