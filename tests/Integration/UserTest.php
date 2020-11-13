<?php

namespace Tests\Integration;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        // Migrate the database
        $this->migrate();
    }

    public function testRoleNotFound(): void
    {
        $user = User::factory()->make();
        self::assertFalse($user->hasRole('chicken'));
    }

    // TODO: Figure out how to modify Spatie/Permissions for Laravel 8.x
    //
//    public function testUserRoleFound(): void
//    {
//        $user = User::factory()->create([
//            'name' => 'Example Super-Admin User',
//            'email' => 'superadmin@example.com',
//        ]);
//
//        $superRole  = Role::create(['name' => 'super-admin']);
//
//        $user->assignRole($superRole);
//
//        self::assertTrue($user->hasRole('super-admin'));
//    }

//    public function testUserRoleWithPermissionsFound(): void
//    {
//        $user = User::factory()->create([
//            'name' => 'Example User',
//            'email' => 'test@example.com',
//        ]);
//
//        Permission::create(['name' => 'edit articles']);
//        Permission::create(['name' => 'delete articles']);
//
//        // create roles and assign existing permissions
//        $writerRole = Role::create(['name' => 'writer']);
//        $writerRole->givePermissionTo('edit articles');
//        $writerRole->givePermissionTo('delete articles');
//        $user->assignRole($writerRole);
//
//        self::assertTrue($user->hasRole('writer'));
//    }

}
