<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Madurawi',
            'email' => 'maduravi@gmail.com',
            'user_type' => (int)2,
            'password' => bcrypt('doctorpass'),
            'email_verified_at'=>Carbon::now()
        ]);
    }
}
