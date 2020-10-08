<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('members')->insert([
            'active' => 1,
            'first_name' => 'Jorge',
            'middle_name' => 'F.X.',
            'last_name' => 'Jones'
        ]);
    }
}
