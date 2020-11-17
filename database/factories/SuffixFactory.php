<?php

namespace Database\Factories;

use App\Models\Suffix;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuffixFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suffix::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(0, 9999),
            'suffix' => $this->faker->unique()->word
        ];
    }
}
