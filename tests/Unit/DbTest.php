<?php
namespace Tests\Unit;

use Database\Seeders\MemberSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\SeedDatabaseState;
use Tests\TestCase;

class DbTest extends TestCase
{

    use DatabaseMigrations {
        runDatabaseMigrations as baseRunDatabaseMigrations;
    }

    public function runDatabaseMigrations(): void
    {
        $this->baseRunDatabaseMigrations();
        $this->artisan('db:seed');
    }

    public function testTrue(): void
    {
        self::assertTrue(true);
    }
}

