<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tienda.test'],
            [
                'name' => 'Administrador',
                'role' => User::ROLE_ADMIN,
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'empleado@tienda.test'],
            [
                'name' => 'Empleado',
                'role' => User::ROLE_EMPLEADO,
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'cliente@tienda.test'],
            [
                'name' => 'Cliente',
                'role' => User::ROLE_CLIENTE,
                'password' => Hash::make('password'),
            ]
        );
    }
}
