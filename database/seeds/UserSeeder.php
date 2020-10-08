<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Shane Poppleton',
            'email' => 'shane@alphasg.com.au',
            'username' => 'codemonkey76',
            'email_verified_at' => now(),
            'password' => Hash::make('secret')
        ]);
    }
}
