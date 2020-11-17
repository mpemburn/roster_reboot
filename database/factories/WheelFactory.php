<?php

namespace Database\Factories;

use App\Models\Wheel;
use Illuminate\Database\Eloquent\Factories\Factory;

class WheelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wheel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'wheel' => $this->faker->word
        ];
    }
}
