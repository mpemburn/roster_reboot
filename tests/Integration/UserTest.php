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
    protected $writerRole;
    protected $adminRole;
    protected $superRole;

    public function setUp(): void
    {
        parent::setUp();
        // Migrate the database
        $this->migrate();
    }

    public function testRoleNotFound(): void
    {
        $user = User::factory()->make();
        self::assertFalse($user->hasRole('chicken'));

        $role = Role::create(['name' => 'turkey']);
        $user->assignRole($role);

        self::assertFalse($user->hasRole('chicken'));
    }

    public function testUserRoleFound(): void
    {
        $user = User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);

        $this->superRole  = Role::create(['name' => 'super-admin']);
        $user->assignRole($this->superRole);

        self::assertTrue($user->hasRole('super-admin'));
    }

    public function testUserRoleWithPermissionsFound(): void
    {
        $user = User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);

        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        // create roles and assign existing permissions
        $this->writerRole = Role::create(['name' => 'writer']);
        $this->writerRole->givePermissionTo('edit articles');
        $this->writerRole->givePermissionTo('delete articles');
        $user->assignRole($this->writerRole);

        self::assertTrue($user->hasRole('writer'));
    }

}
