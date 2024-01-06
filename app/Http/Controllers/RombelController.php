<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use Illuminate\Http\Request;


class RombelController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($request->has('query')) {
            $rombels = Rombel::when($query, function ($query) use ($request) {
                return $query->orWhere('rombel', 'like', '%' . $request->input('query') . '%');
            })
            ->simplePaginate(5);
        }else{
            $rombels = Rombel::with('user')->simplePaginate(5);
        }

        return view("rombel.index", compact('rombels'));

        // $query = $request->input('query');

        // $rombels = Rombel::when($query, function ($queryBuilder) use ($query) {
        //         return $queryBuilder->where('rombel', 'LIKE', "%{$query}%");
        //     })
        //     ->simplePaginate(5);
    
        // return view("rombel.index", compact('rombels', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rombel.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required|',
        ]);

        Rombel::create([
            'rombel' => $request->rombel,
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
        $rombel = Rombel::where('id', $id)->first();
        return view('rombel.edit', compact('rombel'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rombel' => 'required',
        ]);
        Rombel::where('id',$id)->update([
            'rombel' => $request->rombel,
        ]);
        return redirect()->route('rombel.index')->with('success', 'Berhasil mengubah data obat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rombel::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data !');
    }
}
