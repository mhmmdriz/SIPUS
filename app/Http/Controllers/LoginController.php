<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Kategori;
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
        if(auth()->user()->role == 'petugas'){
            $categories = Kategori::selectRaw('kategori.idkategori, kategori.nama, COUNT(buku.idbuku) AS total_buku')
                        ->leftJoin('buku', 'buku.idkategori', '=', 'kategori.idkategori')
                        ->groupBy('kategori.idkategori', 'kategori.nama')->get();
            return view("dashboard.petugas", [
                "categories" => $categories,
            ]);
        }else{
            return view("dashboard.anggota");
        }
    }
    
}
