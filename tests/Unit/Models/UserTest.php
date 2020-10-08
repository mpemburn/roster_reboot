<?php


namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testUserHasEmail(): void
    {
        $user = new User([
            'email' => 'sally@example.com',
        ]);

        $this->assertEquals('sally@example.com', $user->email);

    }

}
