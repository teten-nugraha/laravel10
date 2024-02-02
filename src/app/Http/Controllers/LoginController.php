<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function loginProcess(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' =>  'required|email',
            'password' =>  'required'
        ]);

        $data = [
            'email' =>  $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('login')->with('failed','Email atau password salah');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }

    public function register() {
        return view('auth.register');
    }

    public function registerProcess (Request $request) {
        $request->validate([
            'nama' =>  'required',
            'email' =>  'required|email|unique:users,email',
            'password' =>  'required|min:6'
        ]);

        $data['name']       =   $request->nama;
        $data['email']       =   $request->email;
        $data['password']       =   $request->password;

        User::create($data);
        
        $data = [
            'email' =>  $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('login')->with('failed','Email atau password salah');
        }


    }
}
