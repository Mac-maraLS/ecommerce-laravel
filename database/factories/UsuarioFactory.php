<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * El modelo que genera este factory.
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $nombres   = ['Juan', 'Mario', 'Maria', 'Pedro'];
        $apellidos = ['Lopez', 'Sanchez', 'Hernandez', 'Martinez'];

        $nombre   = $this->faker->randomElement($nombres);
        $apellido = $this->faker->randomElement($apellidos);

        return [
            'nombre'    => $nombre,
            'apellidos' => $apellido,
            'correo'    => strtolower(substr($nombre, 0, 1) . $apellido) . '@tuxtla.tecnm.mx',
            'clave'     => Hash::make('123'),
            'rol'       => $this->faker->randomElement(['cliente', 'gerente']),
        ];
    }
}
