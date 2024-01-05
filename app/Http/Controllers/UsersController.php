<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\rombels;
use App\Models\rayons;
use App\Models\students;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{

    public function dashboard() {
        
        $student = students::count();
        $rombel = rombels::count();
        $rayon = rayons::count();
        $admin = User::where('role', 'admin')->count();
        $ps = User::where('role', 'ps')->count();

        $rayonIds = rayons::where('user_id', Auth::user()->id)->pluck('id');

        $todayLateCount = DB::table('lates')
            ->whereIn('student_id', function ($query) use ($rayonIds) {
                $query->select('id')
                    ->from('students')
                    ->whereIn('rayon_id', $rayonIds);
            })
            ->whereDate('date_time', Carbon::today())
            ->count();
            
        $lates1 = students::whereIn('rayon_id', $rayonIds)->count();

        return view('home', compact('student', 'rombel', 'rayon', 'admin', 'ps', 'todayLateCount', 'lates1'));

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'role' => 'required',
    //     ]);
    //         $defaultPassword = substr($request->email, 0, 3) . substr($request->name, 0, 3);
        
    //         User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'role' => $request->role,
    //             'password' => bcrypt($defaultPassword),
    //         ]);
        
    //         return redirect()->route('user.index')->with('success', 'Berhasil mengubah data pengguna!');
    //     }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ]);

        $defaultPassword = substr($request->email, 0, 3) . substr($request->name, 0, 3);

        // Check if the email already exists
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect()->route('user.index')->with('error', 'Email already exists!');
        }

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($defaultPassword),
        ]);

        return redirect()->route('user.index')->with('success', 'Berhasil menambahkan data pengguna!');
    }

    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('users.edit', compact('users'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $defaultPassword = Str::substr($request->email, 0, 3) . Str::substr($request->name, 0, 3);
        User::where('id', $id)->update([
            'name' => $request->name,
            'email'=> $request->email,
            'role'=> $request->role,
            'password' => bcrypt($defaultPassword),
        ]);
        return redirect()->route('user.index')->with('success', 'Berhasil Mengubah Data User');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data');
    }


    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.alpha_dash' => 'Password harus diisi huruf dan karakter tanpa spasi',
        ]);

        $user = $request->only(['email', 'password']);
        if(Auth::attempt($user)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali dengan data yang benar!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}
