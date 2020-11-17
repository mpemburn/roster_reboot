<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Prefix;
use App\Models\Suffix;
use App\Models\User;
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
            'active' => $this->faker->numberBetween(0, 1),
            'user_id' => User::factory(),
            'prefix_id' => Prefix::factory(),
            'first_name' => $this->faker->firstName,
            'middle_name' =>  $this->faker->firstName,
            'last_name' =>  $this->faker->lastName,
            'suffix_id' => Suffix::factory(),
            'magickal_name' => $this->faker->firstName,
            'member_since_date' => $this->faker->date(),
            'member_end_date' => $this->faker->date(),
            'date_of_birth' => $this->faker->date(),
            'time_of_birth' => $this->faker->date('H:i'),
            'place_of_birth' => $this->faker->locale,
        ];
    }
}
