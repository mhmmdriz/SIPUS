<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PreferenceController extends Controller
{
    public function sidebarCookie(Request $request){
        $cookie = cookie('sidebar', $request->sidebar);
        if($request->sidebar == "close"){
            $cookie1 = cookie('navbar', "open");
        }else{
            $cookie1 = cookie('navbar', "");
        }
        return response()->json(['message' => "sukses"])->withCookie($cookie)->withCookie($cookie1);
    }

    public function themeCookie(Request $request){
        $cookie = cookie('theme', $request->theme);
        return response()->json(['message' => "sukses"])->withCookie($cookie);
    }

}
