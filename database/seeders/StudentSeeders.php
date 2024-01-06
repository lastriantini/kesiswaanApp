<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\student;

class StudentSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'nis' => "12200000",
            'name' => "Laras",
            'rombel_id' => 5,
            'rayon_id' => 2,
        ]);
        Student::create([
            'nis' => "12210000",
            'name' => "Taras",
            'rombel_id' => 4,
            'rayon_id' => 1,
        ]);
        Student::create([
            'nis' => "12220000",
            'name' => "Qaras",
            'rombel_id' => 1,
            'rayon_id' => 5,
        ]);
        Student::create([
            'nis' => "12230000",
            'name' => "Raras",
            'rombel_id' => 5,
            'rayon_id' => 6,
        ]);
        Student::create([
            'nis' => "12240000",
            'name' => "Paras",
            'rombel_id' => 3,
            'rayon_id' => 4,
        ]);
        Student::create([
            'nis' => "12250000",
            'name' => "Faras",
            'rombel_id' => 2,
            'rayon_id' => 3,
        ]);
        Student::create([
            'nis' => "12260000",
            'name' => "Garas",
            'rombel_id' => 2,
            'rayon_id' => 4,
        ]);
        Student::create([
            'nis' => "12270000",
            'name' => "Zaras",
            'rombel_id' => 3,
            'rayon_id' => 2,
        ]);
    }
}
