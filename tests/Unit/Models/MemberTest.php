<?php


namespace Tests\Unit\Models;

use App\Models\Member;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MemberTest extends TestCase
{
    protected $member;

    public function setUp(): void
    {
        parent::setUp();
        $this->member = new Member([
            'active' => 1,
            'first_name' => 'Jorge',
            'last_name' => 'Jones',
        ]);

        (new DatabaseSeeder())->call(MemberSeeder::class);
    }

    public function testMemberHasFirstName(): void
    {
        self::assertEquals('Jorge', $this->member->first_name);
    }

    public function testMemberHasLastName(): void
    {
        self::assertEquals('Jones', $this->member->last_name);
    }

    public function testHasFiftyUsers()
    {
        self::assertEquals(50, Member::count());
    }

}
