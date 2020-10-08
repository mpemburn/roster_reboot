<?php

namespace Tests\Integration;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRoleNotFound()
    {
        $user = User::factory()->make();
        $this->assertFalse($user->hasRole('chicken'));
//
//        $role = factory(Role::class)->create(['name' => 'turkey']);
//        $user->roles()->attach($role->id);
//
//        $this->assertFalse($user->hasRole('chicken'));
    }

}
