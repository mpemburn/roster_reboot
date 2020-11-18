<?php

namespace Tests\Integration;

use App\Models\Email;
use App\Models\Member;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Do artisan migrate:refresh on test database
        $this->refreshDatabase();
        (new DatabaseSeeder())->call(MemberSeeder::class);
    }
    public function testUserHasCurrentMembership(): void
    {
        $member = Member::factory()->create();
        $email = Email::factory()->create();
        $member->emails()->save($email);

        // Test whether the email has been associated with the member
        self::assertTrue($member->emails()->where('email', $email->email)->exists());

        // Attempt to register new user
        $response = $this->post('/api/auth/signup', [
            'name' => 'Mark Pemburn',
            'email' => $email->email,
            'password' => 'zootSu1t',
            'password_confirmation' => 'zootSu1t'
        ]);

        $response->assertStatus(201);

    }
}
