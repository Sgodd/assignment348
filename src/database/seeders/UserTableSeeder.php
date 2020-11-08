<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminAccount = new \App\Models\User([
            'name' => "admin",
            'email' => "admin@test.com",
            'email_verified_at' => now(),
            'password' => Hash::make("admin"),
            'role_id' => 1,
            'remember_token' => Str::random(10),
        ]);

        $adminAccount->save();

        \App\Models\User::factory(10)->create();
    }
}
