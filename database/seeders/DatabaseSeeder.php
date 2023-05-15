<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        User::create([
            "name" => "Thuan Tran",
            "email" => "tvt.thuan241@gmail.com",
            "password" => "thuan221202",
            "role" => 2,
            "is_active" => 1,
        ]);
    }
}
