<?php


namespace Tests\Unit\Models;

use App\Models\Member;
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
            'last_name' => 'Jones'
        ]);
    }

    public function testMemberHasFirstName(): void
    {
        self::assertEquals('Jorge', $this->member->first_name);
    }

   public function testMemberHasLastName(): void
    {
        self::assertEquals('Jones', $this->member->last_name);
    }

}
