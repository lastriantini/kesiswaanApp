<?php

namespace App\Http\Controllers;

use App\Models\Late;
use App\Models\Rayon;
use App\Models\Student;
use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\LateExport;
use Illuminate\Support\Facades\Auth;

class LateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($request->has('query')) {
            $lates = Late::with('student')
                ->when($query, function ($query) use ($request) {
                return $query->orWhere('date_time_late', 'like', '%' . $request->input('query') . '%');
            })
            ->simplePaginate(5);
        }else{
            $lates = Late::with('student')->simplePaginate(5);
        }
        // $lates = Late::with('student')->simplePaginate(5);
        return view("late.index", compact('lates'));
    }

    public function allData(Request $request)
    {
        // Mengambil ID rayon berdasarkan user yang sedang login
        $rayonId = Rayon::where('user_id', Auth::user()->id)->pluck('id')->first();
        // Mengambil ID siswa yang terkait dengan rayon
        $studentIds = Student::where('rayon_id', $rayonId)->pluck('id');
        // dd($rayonId, $studentIds);

        $lates = Late::whereIn('student_id', $studentIds)->simplePaginate(5);

        // $lates = Late::with('student')->get();
        // dd($lates);
        return view("late.ps.allData", compact('lates'));
    }

    public function data(Request $request)
    {
        $lates = Late::selectRaw('lates.student_id as student_id, students.name as student_name, students.nis, COUNT(*) as total_late, MAX(lates.date_time_late) as lates_late_date')
        ->join('students', 'lates.student_id', '=', 'students.id')
        ->groupBy('student_id', 'students.name', 'students.nis')
        ->get();

        $student = Late::with('student')->simplePaginate(5);

        // Pass the $lateCounts data to the 'late.count-and-list-by-name' view
        return view('late.data', compact('lates','student'));
    }

    public function rekap(Request $request)
    {
        // Retrieve the IDs of Rayon associated with the authenticated user
        $rayon = Rayon::where('user_id', Auth::user()->id)->pluck('id');

        // Retrieve the IDs of students associated with the Rayon
        $students = Student::where('rayon_id', $rayon)->pluck('id');

        // Retrieve information about late students
        $lates = Late::selectRaw('lates.student_id as student_id, students.name as student_name, students.nis, COUNT(*) as total_late, MAX(lates.date_time_late) as lates_late_date')
            ->join('students', 'lates.student_id', '=', 'students.id')
            ->groupBy('student_id', 'students.name', 'students.nis')
            ->whereIn('student_id', $students) // Use 'whereIn' instead of 'where' for an array of values
            ->get();

        $student = Late::with('student')->simplePaginate(5);

        // Pass the $lateCounts data to the 'late.count-and-list-by-name' view
        return view('late.ps.rekap', compact('lates','student'));
    }

    public function detail(Request $request, $id){
        $lates = Late::where('student_id', $id)->get();

        // Melewatkan data ke tampilan
        // return view('late.detail', compact('lates', 'id'));

        // Melewatkan data ke tampilan
        return view('late.detail', compact('lates'));
    }

    public function more(Request $request, $id){
        $lates = Late::where('student_id', $id)->get();

        // Melewatkan data ke tampilan
        // return view('late.detail', compact('lates', 'id'));

        // Melewatkan data ke tampilan
        return view('late.ps.more', compact('lates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $query = $request->input('query');
        $lates = Student::with('late')->get();
    
        return view("late.create", compact('lates', 'query'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'date_time_late' => 'required',
                'information' => 'required',
                'bukti' => 'required|file|mimes:jpeg,png,pdf,doc,docx',
            ]);
    
            // Ensure the student exists
            $student = Student::where('name', $request->name)->first();
            if (!$student) {
                return redirect()->back()->with('error', 'Student not found.');
            }
    
            // Get the uploaded file
            $buktiFile = $request->file('bukti');
    
            // Check if the file is valid
            if ($buktiFile->isValid()) {
                // Get the file extension
                $extension = $buktiFile->getClientOriginalExtension();
    
                // Create the Late record
                Late::create([
                    'student_id' => $student->id,
                    'date_time_late' => $request->date_time_late,
                    'information' => $request->information,
                    'bukti' => $buktiFile->storeAs('bukti', time() . '_' . $request->name . '.' . $extension, 'public')
                ]);
    
                return redirect()->back()->with('success', 'Late record added successfully!');
            } else {
                // Handle the case where the file is not valid
                return redirect()->back()->withErrors(['bukti' => 'The bukti field must be a valid file.']);
            }
        } catch (\Exception $e) {
            // Log the exception for further investigation
            \Log::error($e);
    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(late $late)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $late = Late::find($id);
        $lates = Student::with('late')->get();
        return view('late.edit', compact('late', 'lates'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
        ]);
 
        if ($request->bukti == "") {
            Late::where('id', $id)->update([
                'student_id' => $request->student_id,
                'date_time_late' => $request->date_time_late,
                'information' => $request->information,
            ]);
        } else {
            $file = $request->file('bukti');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('bukti', $fileName, 'public');

            if ($request->buktiOld) {
                Storage::delete($request->buktiOld);
            }

            Late::where('id', $id)->update([
                'date_time_late' => $request->date_time_late,
                'information' => $request->information,
                'bukti' => $filePath, // Simpan path atau nama file ke dalam database
                'student_id' => $request->student_id,
            ]);        
        }

        return redirect()->route('late.index')->with('success', 'Berhasil mengganti data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(late $late)
    {
        Student::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function downloadPDF($id) {

        // Retrieve the total late data using a query
        $total_late = Late::selectRaw('lates.student_id as student_id, students.name as student_name, students.nis, COUNT(*) as total_late, MAX(lates.date_time_late) as lates_late_date')
            ->join('students', 'lates.student_id', '=', 'students.id')
            ->groupBy('student_id', 'students.name', 'students.nis')
            ->get();

        // Retrieve the individual student data
        $late = Student::with('rombel', 'rayon')->find($id);

        // Convert the individual student data to an array
        $lates = $late->toArray();

        // Share the data to the view
        view()->share(['total_late' => $total_late, 'lates' => $lates]);

        // Load the PDF view with the shared data
        $pdf = PDF::loadView('late.downloadPDF', ['total_late' => $total_late, 'lates' => $lates]);

        // Download the PDF
        return $pdf->download('Surat pernyataan.pdf');
    }

    public function unduhPDF($id) {

        // Retrieve the total late data using a query
        $total_late = Late::selectRaw('lates.student_id as student_id, students.name as student_name, students.nis, COUNT(*) as total_late, MAX(lates.date_time_late) as lates_late_date')
            ->join('students', 'lates.student_id', '=', 'students.id')
            ->groupBy('student_id', 'students.name', 'students.nis')
            ->get();

        // Retrieve the individual student data
        $late = Student::with('rombel', 'rayon')->find($id);

        // Convert the individual student data to an array
        $lates = $late->toArray();

        // Share the data to the view
        view()->share(['total_late' => $total_late, 'lates' => $lates]);

        // Load the PDF view with the shared data
        $pdf = PDF::loadView('late.ps.unduhPDF', ['total_late' => $total_late, 'lates' => $lates]);

        // Download the PDF
        return $pdf->download('Surat pernyataan.pdf');
    }

    public function exportExcel ()
    {
        $file_name = 'data_ketelatan' . '.xlsx';
        // panggil package excel lakuin proses download, 
        // logic exortnya ada di OrderExport dengan nama file yang telah di tentukan di $file_name
        return Excel::download(new LateExport, $file_name);
    }

    public function excel ()
    {
        $file_name = 'data_ketelatan' . '.xlsx';
        // panggil package excel lakuin proses download, 
        // logic exortnya ada di OrderExport dengan nama file yang telah di tentukan di $file_name
        return Excel::download(new LateExport, $file_name);
    }

}
