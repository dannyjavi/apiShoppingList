<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'danny',
            'email' => 'dannyja8@hotmail.com',
            'password' => Hash::make('ebichu&.819')
        ]);

        User::create([
            'name' => 'maria',
            'email' => 'marianarvaezlinares@hotmail.com',
            'password' => Hash::make('maria')
        ]);
    }
}
