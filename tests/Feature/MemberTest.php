<?php

namespace Tests\Feature;

use App\Models\Member;
use Tests\TestCase;
use Faker\Factory;

class MemberTest extends TestCase
{
    protected array $attributes;

    public function setUp(): void
    {
        parent::setUp();
        // Migrate the database
        $this->migrate();
        $this->setAttributes();
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
