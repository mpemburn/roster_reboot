<?php

namespace Tests\Integration;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        // Migrate the database
        $this->migrate();
    }

    public function testRoleNotFound(): void
    {
        $user = User::factory()->make();
        $this->assertFalse($user->hasRole('chicken'));

        $role = Role::create(['name' => 'turkey']);
        $user->assignRole($role);

        $this->assertFalse($user->hasRole('chicken'));
    }

}
