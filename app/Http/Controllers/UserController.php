<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view ('login');

    }

     
    public function index()
    {
        $users = User::all();
        return view("user.absen", compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user.absen ");
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=>'required',
            'role'=>'required',

    ]);

    User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> bcrypt($request->password),
        'role'=>$request->role,

    ]);
        //

        return redirect()->route('Users')->with('success','berhasil di tambah');
    }

    /**
     * Display the specified resource.
     */
    // public function userLogin()
    // {
    //     return view('user.login');
    // }

    public function edit(string $id){
        $akun = User::where('id', $id)->first();
        return view(view: 'user.update', data: compact(var_name:'akun'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name'=>'required|min:5|max:15',
            'email'=>'required|email',
            'role'=>'required'
        ], [
            'name.required'=>'nama akun wajib diisi',
            'name.min'=>'nama akun minimal 5 karakter',
            'name.max'=>'nama akun maximal 15 karakter',
            'role.required'=>'harga obat wajib diisi',
        ]);
        // validasi required berguna agar tidak boleh kosong/harus berisi
        //mebambahkan data ke database
        // 'name_field_migration =>$request->name_input_form
        // $proses = Medicine::create([
        //     'type'=>$request->type,
        //     'name'=>$request->name,
        //     'price'=>$request->price,
        //     'stock'=>$request->stock
        // ]);

        $akunBefore = User::where('id',$id)->first();

        $proses = $akunBefore->update([
            'name' => $request -> name,
            'email' => $request -> email,
            'role' => $request -> role,
           
            
        ]);

        if ($proses) {
            return redirect()->route('Users')->with('success','data akun berhasil dirubah');
        } else {
            return redirect()->route('Users.absen')->with('failed','gagal merubah data akun');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    // public function login(Request $request) 
    // {
    //     $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required|min:8',
    //     ]);
        
    //     if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
    //         $users = Auth::user();
    //         if($users->role == 'admin') {
    //             return redirect()->route('admin.dashboard')->with('success','Login Berhasil sebagai admin');
    //         }elseif($users->role == 'kasir'){
    //             return redirect()->route('kasir.dashboard')->with('success','Login Berhasil sebagai kasir');
    //         }
    //     }
    //     return back()->withErrors([
    //         'email'=> 'email atau password salah.',])->withInput($request->only('email'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function absen()
    {
        return view('user.absen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proses = User::where('id',$id)->delete();
        if ($proses) {
            return redirect()->back()->with('success','data obat berhasil dihapus!');
        } else {
            return redirect()->back()->with('failed', 'gagal menghapus data obat!');
        }
        //
    }
public function loginAuth(Request $request)
    {
        //email:dns->validasi email ada @
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        //menyimpan isi form email dan pasword di variabel $user
        $user = $request->only(['email', 'password']);
        //aunth::attempt -> cek kecocokan email dan pw (HASH) (verfikasi) , kalau cocok simpann data di riwayat login (di aunth)

        if (Auth::attempt($user)) {
            //jika berhasil memverifikasi maka diarahkan ke landing page
            return redirect()->route('landing_page');
        } else {
            //jika gagal memverifikasi maka akan di arahkan kembali dengan pesan error
            return redirect()->back()->with('failed', 'email atau password salah silahkan coba kembali dengan data yang benar');

        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('succes', 'logout Success');
    }
}
