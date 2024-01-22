<?php

namespace App\Http\Controllers;

use App\Models\lates;
use App\Models\students;
use App\Models\rayons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\LatesExport;
use App\Exports\psLatesExport;

class LatesController extends Controller
{
    public function index()
    {
        $lates = lates::with('students')->get();
        $groupedLates = $lates->groupBy('students.nis'); // Group data by student NIS
        return view('lates.admin.index', compact('lates', 'groupedLates'));
    }

    public function detail($student_id)
    {
        $siswa = students::findOrFail($student_id);
    
    // Retrieve late records for the selected student
    $lates = lates::where('student_id', $siswa->id)->with('students')->get();
    $groupedLates = $lates->groupBy('students.nis'); 

    return view('lates.admin.detail', compact('lates','groupedLates'));
    }

    public function search(Request $request)
    {
    $searchTerm = $request->input('search');
    $lates = lates::where('date_time', 'like', '%' . $searchTerm . '%')->paginate(5);

    return view('lates.admin.index', compact('lates'));
    }

    

    public function create()
    {
        $siswas = students::all();
        $students = students::all();
        return view('lates.admin.create', compact('siswas', 'students'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'student_id'=>'required',
            'date_time' => 'required|date',
            'information' => 'required|string',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->bukti->extension();
        $request->bukti->move(public_path('images'), $imageName);

        lates::create([
            'student_id'=> $request->student_id,
            'date_time' => $request->date_time,
            'information' => $request->information,
            'bukti' => $imageName,
        ]);

        return redirect()->route('lates.index')->with('success', 'Data Keterlambatan added successfully.');
    }


    public function edit($id)
    {
        $lates = lates::find($id);
        $students = students::all();
        return view('lates.admin.edit', compact('lates','students'));
    }

    public function update(Request $request, lates $lates)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_time_late' => 'required|date',
            'information' => 'required|string',
            'bukti' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('bukti')) {
            $imageName = time() . '.' . $request->bukti->extension();
            $request->bukti->move(public_path('images'), $imageName);
            $lates->update(['bukti' => $imageName]);
        }

        $lates->update([
            'name' => $request->name,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ]);

        return redirect()->route('lates.index')->with('success', 'Data Keterlambatan updated successfully.');
    }

    public function destroy($id)
    {
        lates::where('id',$id)->delete();
        return redirect()->route('lates.index')->with('success', 'Data Keterlambatan deleted successfully.');
    }

    public function downloadPDF($id)
    {
    $lates = lates::with('students.lates')->find($id);

    $students = $lates->students;

    $jumlahKeterlambatan = $students->lates->count();

    $pdf = PDF::loadView('lates.admin.download-pdf', compact('lates', 'students', 'jumlahKeterlambatan'));

    return $pdf->stream('receipt.pdf');
    }

    public function exportExcel()
    {

    $file_name = 'data'.'.xlsx';
    
    return Excel::download(new LatesExport, $file_name);
    
    }

    // untuk PS

    public function rekap()
    {
        $rayonIds = rayons::where('user_id', Auth::User()->id)->pluck('id');
        $siswa = students::whereIn('rayon_id', $rayonIds)->get();
        $lates = lates::whereIn('student_id', $siswa->pluck('id'))->with('students')->get();
        
        // Kelompokkan data keterlambatan berdasarkan NIS siswa
        $groupedLates = $lates->groupBy('students.nis');
    
        return view('lates.ps.index', compact('lates', 'groupedLates', 'siswa'));
        
    }

    // public function psdetail()
    // {
    //     $rayonIds = rayons::where('user_id', Auth::User()->id)->pluck('id');
    //     $siswa = students::whereIn('rayon_id', $rayonIds)->get();
    //     $lates = Lates::whereIn('student_id', $siswa->pluck('id'))->with('students')->get();
        
    //     // Kelompokkan data keterlambatan berdasarkan NIS siswa
    //     $groupedLates = $lates->groupBy('student.nis');
    
    //     return view('lates.ps.detail', compact('lates', 'groupedLates', 'siswa'));
    // }
    public function psdetail($nis)
{
    $rayonIds = rayons::where('user_id', Auth::user()->id)->pluck('id');
    $student = students::where('nis', $nis)->whereIn('rayon_id', $rayonIds)->first();
    $lates = Lates::where('student_id', $student->id)->with('students')->get();

    return view('lates.ps.detail', compact('lates', 'student'));
}


    public function psdownloadPDF($id)
    {
    $lates = lates::with('students.lates')->find($id);

    $students = $lates->students;

    $jumlahKeterlambatan = $students->lates->count();

    $pdf = PDF::loadView('lates.ps.download-pdf', compact('lates', 'students', 'jumlahKeterlambatan'));

    return $pdf->stream('receipt.pdf');
    }

    public function psexportExcel()
    {
        $rayonId = Auth::User()->rayon_id;
        $file_name = 'data'.'.xlsx';

        return Excel::download(new psLatesExport($rayonId), $file_name);
    }

}