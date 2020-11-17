<?php

namespace Database\Factories;

use App\Models\Prefix;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrefixFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prefix::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(0, 9999),
            'prefix' => $this->faker->unique()->word
        ];
    }
}
