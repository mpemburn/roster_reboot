<?php

namespace Tests\Integration;

use App\Models\Coven;
use App\Models\Email;
use App\Models\Member;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use Faker\Factory;
use Tests\TestCase;

class CreateMemberTest extends TestCase
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

    public function testMemberCanBeCreated(): void
    {
        $this->withoutExceptionHandling();

        $member = Member::factory()->create();

        // Attempt to create new Member
        $response = $this->post('/api/member', $member->toArray());

        $response->assertStatus(201);

        $this->assertDatabaseHas('members', $member->toArray());
    }

    public function testMemberCanBeAddedToCoven(): void
    {
        $this->withoutExceptionHandling();

        $member = Member::factory()->create();
        $coven = Coven::factory()->create();

        $response = $this->post('/api/member_coven', ['member_id' => $member->id, 'coven_id' => $coven->id]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('members', ['coven_id' => $coven->id]);
    }

    public function testEmailCanBeAddedToMember(): void
    {
        $this->withoutExceptionHandling();

        $member = Member::factory()->create();
        $email = Email::factory()->create();

        $response = $this->post('/api/member_email', [
            'member_id' => $member->id,
            'email' => $email->email,
            'description' => $email->description,
            'is_primary' => $email->is_primary
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('emails', $email->toArray());
    }
}

