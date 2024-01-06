<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\User;
use Illuminate\Http\Request;


class RayonController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $query = $request->input('query');
        // Use optional() to handle the case when 'query' is not present
        // $orders = Rayon::when($query, function ($query) use ($request) {
        //                 return $query->orWhereDate('created_at', '=', $request->input('query'));
        //             })
        //             ->simplePaginate(5);
        // $rayons = User::where('role', 'ps')->simplePaginate(5);
        $query = $request->input('query');
        if ($request->has('query')) {
            $rayons = Rayon::when($query, function ($query) use ($request) {
                return $query->orWhere('rayon', 'like', '%' . $request->input('query') . '%');
            })
            ->simplePaginate(5);
        }else{
            $rayons = Rayon::with('user')->simplePaginate(5);
        }
        // $rayons = Rayon::orderBy('rayon', 'ASC')->simplePaginate(5);
        return view("rayon.index", compact('rayons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayons = User::where('role', 'ps')->get();
        return view("rayon.create", compact('rayons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'name' => 'required'
        ]);
    
        $user = User::where('name', $request->name)->first();
        // dd($user);

        Rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $user->id,
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
    public function edit(Request $request, $id)
    {
        $id = Rayon::find($id);
        $rayons = User::where('role', 'ps')->get();
        return view('rayon.edit', compact('rayons', 'id'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $users = User::where('name', $request->name)->first();

        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);
        Rayon::where('id',$id)->update([
            'rayon' => $request->rayon,
            'user_id' => $users->id,
        ]);
        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data obat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rayon::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data !');
    }
}
