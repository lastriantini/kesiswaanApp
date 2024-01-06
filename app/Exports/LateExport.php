<?php

namespace App\Exports;

use App\Models\Late;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class LateExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Fetch distinct student records with the total count of lateness
        return Late::select('student_id', DB::raw('count(*) as total'))
            ->groupBy('student_id')
            ->with(['student' => function ($query) {
                $query->with('rombel', 'rayon'); // Load the relationships
            }])
            ->get();
    }

    public function headings(): array
    {
        return [
            "Nis", "Nama", "Rombel", "Rayon", "Total Keterlambatan"
        ];
    }

    public function map($late): array
    {
        $student = $late->student;

        return [
            $student->nis,
            $student->name,
            $student->rombel->rombel,
            $student->rayon->rayon,
            $late->total,
        ];
    }
}