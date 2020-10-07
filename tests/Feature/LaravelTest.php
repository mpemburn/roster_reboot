<?php
namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Bus;
use Tests\SeedDatabaseState;
use Tests\TestCase;

class LaravelTest extends TestCase
{
    use DatabaseMigrations {
        runDatabaseMigrations as baseRunDatabaseMigrations;
    }

    public function setUp(): void
    {
        parent::setUp();
        SeedDatabaseState::$seeders = [UserSeeder::class];
        $this->seedDatabase();
    }

    public function runDatabaseMigrations(): void
    {
        $this->baseRunDatabaseMigrations();
        $this->artisan('db:seed');
    }

    public function testDatabase(): void
    {
        $this->assertDatabaseHas('users', [
            'email' => 'sally@example.com',
        ]);
    }
}

