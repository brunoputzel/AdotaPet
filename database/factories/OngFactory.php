<?php

namespace Database\Factories;

use App\Enums\OngStatus;
use App\Models\Ong;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ong>
 */
class OngFactory extends Factory
{
    protected $model = Ong::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['tipo_perfil' => 'ong_protetor']),
            'cnpj'    => $this->faker->unique()->numerify('##.###.###/####-##'),
            'status'  => OngStatus::Pendente,
        ];
    }

    public function pendente(): static
    {
        return $this->state(['status' => OngStatus::Pendente]);
    }

    public function aprovada(): static
    {
        return $this->state(['status' => OngStatus::Aprovada]);
    }

    public function recusada(): static
    {
        return $this->state(['status' => OngStatus::Recusada]);
    }
}
