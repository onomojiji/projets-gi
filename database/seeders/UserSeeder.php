<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'inimini',
            'sex' => 'M',
            'matricule' => '22INI00001',
            'email' => 'iniminimanimal13@gmail.com',
            'phone' => '+237242423396',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('Moufinimini'),
            'remember_token' => Str::random(25),
            'admin' => 1
        ]);

        // create 10 user by using UserFactory
        User::factory()->count(51)->create();
    }
}
