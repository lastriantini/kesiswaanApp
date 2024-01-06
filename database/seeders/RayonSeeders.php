<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Rayon;

class RayonSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rayon::create([
            'rayon' => "Tajur 4",
            'user_id' => 2,
        ]);
        Rayon::create([
            'rayon' => "Tajur 3",
            'user_id' => 4,
        ]);
        Rayon::create([
            'rayon' => "Cicurug 2",
            'user_id' => 5,
        ]);
        Rayon::create([
            'rayon' => "Cisarua 4",
            'user_id' => 6,
        ]);
        Rayon::create([
            'rayon' => "Cibedug 6",
            'user_id' => 7,
        ]);
    }
}
