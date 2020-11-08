<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role([
            'permissions_flag' => Role::getFlag([
                "READ", 
                "EDIT",
                "DELETE"
            ]),
            'description' => "admin"
        ]);


        $moderator = new Role([
            'permissions_flag' => Role::getFlag([
                "READ", 
                "DELETE"
            ]),
            'description' => "moderator"
        ]);

        $user = new Role([
            'permissions_flag' => Role::getFlag([
                "READ", 
            ]),
            'description' => "user"
        ]);

        $noaccess = new Role([
            'permissions_flag' => Role::getFlag([

            ]),
            'description' => "noaccess"
        ]);

        $admin     -> save();
        $moderator -> save();
        $user      -> save();
        $noaccess  -> save();
    }
}
