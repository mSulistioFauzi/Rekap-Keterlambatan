<?php

namespace App\Http\Controllers;

use App\Models\students;
use App\Models\rayons;
use App\Models\rombels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = students::all();
        $rombels = rombels::all();
        $rayons = rayons::all();
        return view('siswas.admin.index', compact('students', 'rayons', 'rombels'));
    }

    /** untuk guru */
    public function data()
    {
        $rayonIds = rayons::where('user_id', Auth::user()->id)->pluck('id');
        $siswa = students::whereIn('rayon_id', $rayonIds)->get();

        return view('siswas.ps.data', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = students::all();
        $rombels = rombels::all();
        $rayons = rayons::all();
        return view('siswas.admin.create', compact( 'students','rayons','rombels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

      

        students::create([
            'id' => Str::uuid(),
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);
        

            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = students::find($id);
        $rombels = rombels::all();
        $rayons = rayons::all();
        return view('siswas.admin.edit', compact('students', 'rombels', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        Students::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

            return redirect()->route('student.index')->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Students::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Data Berhasil Dihapus!');
    }

    
}