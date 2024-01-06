<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            //  column => value
            'name' => "Administrator",
            'email' => "admin@gmail.com",
            "password" => Hash::make("akunadmin"),
            'role' => "admin",
            // cara lain enkripsi bcypt

        ]);
        User::create([
            //  column => value
            'name' => "ps tajur 4",
            'email' => "Guru@gmail.com",
            "password" => Hash::make("akunguru"),
            'role' => "ps",
        ]);
        User::create([
            //  column => value
            'name' => "ps tajur 3",
            'email' => "Taj3@gmail.com",
            "password" => Hash::make("akunguru"),
            'role' => "ps",
        ]);
        User::create([
            //  column => value
            'name' => "ps cicurug 2",
            'email' => "Cic2@gmail.com",
            "password" => Hash::make("akunguru"),
            'role' => "ps",
        ]);
        User::create([
            //  column => value
            'name' => "ps cisarua 4",
            'email' => "Cis4@gmail.com",
            "password" => Hash::make("akunguru"),
            'role' => "ps",
        ]);
        User::create([
            //  column => value
            'name' => "ps cibedug 6",
            'email' => "Cib6@gmail.com",
            "password" => Hash::make("akunguru"),
            'role' => "ps",
        ]);
    }
}
