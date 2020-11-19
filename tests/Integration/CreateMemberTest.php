<?php

namespace Tests\Integration;

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
}
