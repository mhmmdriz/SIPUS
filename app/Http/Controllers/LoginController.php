<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if(auth()->user()->role == 'anggota'){
                if(auth()->user()->anggota->status == 0){
                    Auth::logout();
                    return back()->with('loginError', 'Login Failed!');
                }
            }
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // $user = User::select('email', 'password', 'role')->where("email", "=", $credentials['email'])->get();
        // // dd($credentials["password"]);
        // if ($user->count() > 0){
        //     if (Hash::check($credentials["password"], $user[0]->password)) {
        //         if($user[0]->role == 'anggota'){
        //             $anggota = Anggota::select('status')->where("email", "=", "$user->email")->get();
        //             if($anggota->status == 'aktif'){
        //                 $request->session()->regenerate();
        //                 return redirect()->intended('/');
        //             }
        //         }else{
        //             $request->session()->regenerate();
        //             return redirect()->intended('/');
        //         }
        //     }
        // }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function dashboard(){

    }
    
}
