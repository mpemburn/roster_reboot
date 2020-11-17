<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Prefix;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Member::factory()
            ->times(50)
            ->create();
    }
}
