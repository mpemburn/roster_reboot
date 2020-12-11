<?php

namespace Tests\Feature;

use App\Models\Member;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use JsonException;
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

        $authToken = $this->getAuthToken();

        self::assertNotNull($authToken);

        $this->post('/member', array_merge(['auth_token' => $authToken], $this->attributes));

        $this->assertDatabaseHas('members', $this->attributes);
    }

    public function testCanRetrieveMembers(): void
    {
        $this->withoutExceptionHandling();

        $authToken = $this->getAuthToken();

        self::assertNotNull($authToken);

        $response = $this->json('GET', '/api/members', ['auth_token' => $authToken]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => array_keys((new Member())->toArray())
            ]
        ]);
    }
//
//    public function testCanUpdateMember(): void
//    {
//        $this->withoutExceptionHandling();
//        $member = Member::factory()->create();
//        $this->post('/member', $member->toArray());
//        $this->assertDatabaseHas('members', $member->toArray());
//
//        $member->first_name = 'Bill';
//
//        $this->putJson('/api/member_update/' . $member->id, $member->toArray());
//
//        $this->assertDatabaseHas('members', $member->toArray());
//    }
//
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

    protected function getAuthToken(): ?string
    {
        $response = $this->json('GET', '/api/get_auth', ['key' => env('AUTH_USER_KEY')]);
        $response->assertStatus(200)
            ->assertJsonStructure([
            'auth_token'
        ]);

        try {
            $content = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return null;
        }

        return $content ? $content['auth_token'] : null;
    }
}
