<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'active' => rand(0,1),
            'user_id' => rand(1, 9999),
            'prefix' => $this->faker->title,
            'first_name' => $this->faker->firstName,
            'middle_name' =>  $this->faker->firstName,
            'last_name' =>  $this->faker->lastName,
        ];
    }
}