<?php


namespace Tests\Unit;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\SeedDatabaseState;

class UserModelTest extends DbTest
{
    public function setUp(): void
    {
        parent::setUp();
        SeedDatabaseState::$seeders = [UserSeeder::class];
        $this->seedDatabase();
    }

    public function testUserHasEmail(): void
    {
        $user = new User([
            'email' => 'sally@example.com',
        ]);

        $this->assertEquals('sally@example.com', $user->email);

    }

}
