<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\database;

class login extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function aksilogin(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");

        $where = array(
            'name' => $username,
            'password' => $password
        );


        $girasya = new database();
       $zelly = $girasya->pull('users', $where);

        if ($zelly) {
            session(['u' => $zelly->name]);
            return redirect()->intended('/home');
        } else {
            return redirect('/');
        }
    }
  public function home(Request $request)
{ 
    if (session('u') > 0) {
        $start_id = $request->input('start_id');
        $end_id = $request->input('end_id');

        // Jika user mengisi rentang ID (dari ... sampai ...)
        if ($start_id && $end_id) {
            $helo['hai'] = \DB::table('users')
                ->whereBetween('id', [$start_id, $end_id])
                ->get();
        } else {
            // Jika tidak di-filter, tampilkan semua data
            $girasya = new database();
            $helo['hai'] = $girasya->tampil('users');
        }

        return view('home', $helo);
    } else {
        return redirect()->intended('/');
    }
}
 public function signup(Request $request){
    $girasya = $request->validate([
        'name' => 'required',
        'email'=> 'required|email|unique:users,email',
        'password' => 'required|confirmed',
    ]);
    database::create ($girasya);
    session(['u' => $girasya['name']]);
    return redirect('/home')->with('succes','data berhasil');
 }
  public function register()
    {
        return view("inputdata");
    }
    public function logout(){
        session()->flush();
        return redirect()->intended('/');
    }
}