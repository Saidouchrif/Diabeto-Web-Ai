<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->lastName(),
            'sexe' => $this->faker->randomElement(['male', 'female']),
            'age' => $this->faker->numberBetween(18, 80),
            'glucose' => $this->faker->numberBetween(70, 120),
            'bmi' => $this->faker->numberBetween(18, 30),
            'blood_pressure' => $this->faker->numberBetween(120, 140),
            'pedigree' => $this->faker->numberBetween(0, 1),
            'result' => $this->faker->randomElement(['positive', 'negative']),
            'id_medecin' => User::factory(),
        ];
    }
}
