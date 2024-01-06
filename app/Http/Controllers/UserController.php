<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Late;
use App\Models\Student;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function loginAuth(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        // Get email and password from the request
        $credentials = $request->only(['email', 'password']);
    
        // Attempt authentication
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('failed', 'Email and password do not match. Please try again!');
        }
    }
    
    public function dashboard()
    {
        $rayons = Rayon::where('user_id', Auth::user()->id)->pluck('id');
        $students = Student::whereIn('rayon_id', $rayons)->pluck('id');
        $late = Late::whereIn('student_id', $students)
            ->whereDate('date_time_late', Carbon::today())
            ->get();
        $todayLateCount = $late->count();
        
        $lates= Student::whereIn('rayon_id', $rayons)->count();

        $rayon = Rayon::where('user_id', Auth::user()->id)->pluck('rayon')->first();
        $todayLateCount = Late::whereDate('date_time_late', Carbon::today())->count();

        return view('index', compact('todayLateCount', 'lates', 'rayon'));
    }

    public function logout()
    {
        // menghapus ssession/data login (auth)
        Auth::logout();
        // setelah dihapus, diserahkan ke
        return redirect()->route('login');
    }


    public function index(Request $request)
    {

        $query = $request->input('query');
        if ($request->has('query')) {
            $users = User::when($query, function ($query) use ($request) {
                return $query->orWhere('name', 'like', '%' . $request->input('query') . '%');
            })
            ->simplePaginate(5);
        }else{
            $users = User::orderBy('name', 'ASC')->simplePaginate(5);
        }

        return view("user.index", compact('users'));
    }

    
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('user.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required',
                'role' => 'required',
            ]);
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make(substr($request->name, 0, 3). substr($request->email, 0, 3))
            ]);
    
            return redirect()->route('user.index')->with('success', 'Berhasil menambahkan data user!');
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
        $id = User::find($id);
        return view("user.edit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        return redirect()->route('user.index')->with('success', 'Berhasil menambahkan data user!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data !');
    }
}
