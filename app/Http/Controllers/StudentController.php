<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($request->has('query')) {
            $students = Student::with('rayon', 'rombel')
                ->when($query, function ($query) use ($request) {
                return $query->orWhere('name', 'like', '%' . $request->input('query') . '%');
            })
            ->simplePaginate(5);
        }else{
            $students = Student::with('rayon','rombel')->simplePaginate(5);
        }

        return view("student.index", compact('students'));
        
        // $query = $request->input('query');
        // $students = Student::with('rayon', 'student')->simplePaginate(5);
    
        // return view("student.index", compact('students', 'query'));
    }

    public function data(Request $request)
    {
        $rayon = Rayon::where('user_id', Auth::user()->id)->pluck('id');

        $query = $request->input('query');
        
        $students = Student::with(['rayon', 'rombel'])
            ->whereIn('rayon_id', $rayon)
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->orWhere('name', 'like', '%' . $query . '%');
            })
            ->simplePaginate(5);
        
        return view("student.ps.data", compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $query = $request->input('query');
        $students = Student::with('rayon', 'rombel')->get();
    
        return view("student.create", compact('students', 'query'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $request->validate([
             'nis' => 'required',
             'name' => 'required',
             'rombel' => 'required',
             'rayon' => 'required',
         ]);
     
         $rayon = Rayon::where('rayon', $request->rayon)->first();
         $rombel = Rombel::where('rombel', $request->rombel)->first();
 
         Student::create([
             'nis'=> $request->nis,
             'name'=> $request->name,
             'rombel_id'=> $rombel->id,
             'rayon_id' => $rayon->id,
         ]);
     
         return redirect()->back()->with('success', 'Berhasil menambahkan data!');
     }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Student::find($id);
        $students = Student::with('rayon', 'rombel')->get();
    
        return view("student.edit", compact('students', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel' => 'required',
            'rayon' => 'required',
        ]);
    
        $rayon = Rayon::where('rayon', $request->rayon)->first();
        $rombel = Rombel::where('rombel', $request->rombel)->first();

        Student::create([
            'nis'=> $request->nis,
            'name'=> $request->name,
            'rombel_id'=> $rombel->id,
            'rayon_id' => $rayon->id,
        ]);
    
        return redirect()->route('student.index')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Student::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
