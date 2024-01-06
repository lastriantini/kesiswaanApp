<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeders::class);
        $this->call(RayonSeeders::class);
        $this->call(RombelSeeders::class);
        $this->call(StudentSeeders::class);
        $this->call(LateSeeders::class);
    }
}
