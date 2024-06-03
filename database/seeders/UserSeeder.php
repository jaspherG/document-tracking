<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admission',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('User123'),
            'type' => 'Admission',
        ]);
    }
}
