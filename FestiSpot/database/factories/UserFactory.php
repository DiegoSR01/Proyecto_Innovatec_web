<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = explode(' ', fake()->name(), 2);
        return [
            'nombre' => $nombres[0],
            'apellido' => $nombres[1] ?? 'Sin especificar',
            'email' => fake()->unique()->safeEmail(),
            'email_verificado' => fake()->boolean(80),
            'password' => static::$password ??= Hash::make('password'),
            'telefono' => fake()->phoneNumber(),
            'fecha_nacimiento' => fake()->date('Y-m-d', '-18 years'),
            'genero' => fake()->randomElement(['masculino', 'femenino', 'otro', 'prefiero_no_decir']),
            'rol_id' => 1, // Por defecto asistente
            'estado' => 'activo',
            'fecha_registro' => fake()->dateTimeBetween('-1 year', 'now'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
