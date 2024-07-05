<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Super Admin",
            "email" => "admin@admin.com",
            "first_name" => "100100",
            "last_name" => "29506200111518",
            "password" => "admin",
        ]);
    }
}
