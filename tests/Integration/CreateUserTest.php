<?php

namespace Tests\Integration;

use App\Models\Email;
use App\Models\Member;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use Faker\Factory;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        // Do artisan migrate:refresh on test database
        $this->refreshDatabase();
        (new DatabaseSeeder())->call(MemberSeeder::class);

        $this->faker = Factory::create();
    }

    public function testUserCanBeCreated(): void
    {
        $this->withoutExceptionHandling();

        $member = Member::factory()->create();
        $email = Email::factory()->create();
        $member->emails()->save($email);

        // Test whether the email has been associated with the member
        self::assertTrue($member->emails()->where('email', $email->email)->exists());

        $password = $this->faker->password;
        $attributes = [
            'name' => $this->faker->firstName,
            'email' => $email->email,
            'password' => $password,
            'password_confirmation' => $password
        ];

        // Attempt to register new user
        $response = $this->post('/api/auth/signup', $attributes);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => $attributes['name'],
            'email' => $attributes['email']
        ]);
    }
}
