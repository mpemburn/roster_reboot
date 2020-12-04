<?php

namespace Tests\Feature;

use App\Models\Member;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use Tests\TestCase;
use Faker\Factory;

class MemberTest extends TestCase
{
    protected array $attributes;

    public function setUp(): void
    {
        parent::setUp();
        // Do artisan migrate:refresh on test database
        $this->refreshDatabase();
        $this->setAttributes();
        (new DatabaseSeeder())->call(MemberSeeder::class);
    }

    public function testUserCanCreateMember(): void
    {
        $this->withoutExceptionHandling();

        $this->post('/member', $this->attributes);

        $this->assertDatabaseHas('members', $this->attributes);
    }

    public function testCanRetrieveMembers(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->json('GET', '/api/members');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => array_keys((new Member())->toArray())
            ]
        ]);
    }

    public function testCanUpdateMember(): void
    {
        $this->withoutExceptionHandling();
        $member = Member::factory()->create();
        $this->post('/member', $member->toArray());
        $this->assertDatabaseHas('members', $member->toArray());

        $member->first_name = 'Bill';

        $this->putJson('/api/member_update/' . $member->id, $member->toArray());

        $this->assertDatabaseHas('members', $member->toArray());
    }

    protected function setAttributes(): void
    {
        $faker = Factory::create();

        $this->attributes = [
            'active' => 1,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'member_since_date' => $faker->date()
        ];
    }
}
