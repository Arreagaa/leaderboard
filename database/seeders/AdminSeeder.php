<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'tecumaninvitational@gmail.com',
                'password' => '$2y$10$/jJXmPikmE/vgn1HdPt8QOwa3qTMez0HoS6TSMsKNtrCcLxOfTWQm',
            ]
        );
    }
}
