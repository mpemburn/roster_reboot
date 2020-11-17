<?php

namespace Database\Factories;

use App\Models\Coven;
use App\Models\Element;
use App\Models\Wheel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CovenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coven::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'abbreviation' => $this->faker->lexify('???'),
            'wheel' => Wheel::factory()->create()->wheel,
            'element' => Element::factory()->create()->element,
        ];
    }
}
