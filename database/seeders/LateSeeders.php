<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Late;

class LateSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "telat bangun",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 1,
        ]);
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "macet",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 2,
        ]);
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "penutupan jalan longsor",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 3,
        ]);
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "jarak rumah jauh",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 4,
        ]);
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "begadang",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 5,
        ]);
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "sakit",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 6,

        ]);
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "telat bangun",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 7,
        ]);
        Late::create([
            'date_time_late' => "2022-12-25T01:3",
            'information' => "macet",
            'bukti' => "bukti/1704348421_Raras.jpg",
            'student_id' => 8,
        ]);

    }
}
