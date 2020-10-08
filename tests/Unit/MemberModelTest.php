<?php


namespace Tests\Unit;

use App\Models\Member;
use Tests\TestCase;

class MemberModelTest extends TestCase
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
        $this->assertEquals('Jorge', $this->member->first_name);
    }

   public function testMemberHasLastName(): void
    {
        $this->assertEquals('Jones', $this->member->last_name);
    }

}
