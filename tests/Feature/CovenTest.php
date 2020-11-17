<?php

namespace Tests\Feature;

use App\Models\Coven;
use Database\Factories\CovenFactory;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use Tests\TestCase;

class CovenTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Do artisan migrate:refresh on test database
        $this->refreshDatabase();
        (new DatabaseSeeder())->call(MemberSeeder::class);
    }

    public function testUserCanCreateCoven(): void
    {
        $coven = Coven::factory()->create();
        $attributes = $coven->first()->toArray();
        $this->post('/coven', $attributes);

        $this->assertDatabaseHas((new Coven())->getTable(), $attributes);
    }

    public function testCanRetrieveCovens(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->json('GET', '/api/covens');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => array_keys((new Coven())->toArray())
            ]
        ]);
    }


}
