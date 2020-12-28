<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = new \App\Models\Image([
            "path" => "profiles/admin.png",
            "imageable_type" => \App\Models\User::class,
            "imageable_id" => 1
        ]);

        $moderator = new \App\Models\Image([
            "path" => "profiles/moderator.png",
            "imageable_type" =>  \App\Models\User::class,
            "imageable_id" => 2
        ]);

        $admin->save();
        $moderator->save();
        
    }
}
