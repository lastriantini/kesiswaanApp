<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Rombel;

class RombelSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rombel::create ([
            'rombel' => "DKV XI-1",
        ]);
        Rombel::create ([
            'rombel' => "DKV XI-2",
        ]);
        Rombel::create ([
            'rombel' => "PPLG XI-3",
        ]);
        Rombel::create ([
            'rombel' => "PPLG XI-4",
        ]);
        Rombel::create ([
            'rombel' => "PPLG XI-5",
        ]);
        Rombel::create ([
            'rombel' => "MPLB XI-3",
        ]);
        Rombel::create ([
            'rombel' => "MPLB XI-4",
        ]);
        Rombel::create ([
            'rombel' => "PMN XI-2",
        ]);
    }
}
