<?php

namespace App\Http\Controllers;

use App\Models\rombels;
use Illuminate\Http\Request;

class RombelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombel = rombels::all();
        return view('rombels.index', compact('rombel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rombels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'rombel' => 'required',
        ]);

        Rombels::create([
            'rombel' => $request->rombel,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data rombel!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombels $rombels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombel = rombels::find($id);
        return view('rombels.edit', compact('rombel'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rombel' => 'required',
        ]);

        rombels::where('id', $id)->update([
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('rombel.index')->with('success', 'berhasil mengubah data!');
    }

    public function delete($id)
    {
        rombels::where('id', $id)->delete();

        return redirect()->route('rombel.index')->with('deleted', 'berhasil menghapus data!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rombels $id)
    {
        rombels::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data');
    }
}
