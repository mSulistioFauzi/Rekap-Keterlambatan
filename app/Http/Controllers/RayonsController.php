<?php

namespace App\Http\Controllers;

use App\Models\rayons;
use App\Models\User;
use Illuminate\Http\Request;

class RayonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rayon = rayons::all();
        $users = User::all();
        return view('rayons.index', compact('rayon', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayon = rayons::all();
        $users = User::all();
        return view('rayons.create', compact('rayon', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);

        rayons::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data rayon!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayons $rayons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rayons = rayons::find($id);
        $users = User::all();
        return view('rayons.edit', compact('rayons', 'users'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);

        rayons::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'berhasil mengubah data!');
    }

    public function delete($id)
    {
        rayons::where('id', $id)->delete();

        return redirect()->route('rayon.index')->with('deleted', 'berhasil menghapus data!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rayons $rayons)
    {
        //
    }
}
