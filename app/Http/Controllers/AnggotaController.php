<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_anggota = Anggota::get();

        $applicants = $data_anggota->where('status', 0);
        $members = $data_anggota->where('status', 1);

        return view('anggota.index',[
            "applicants" => $applicants,
            "members" => $members,
        ]);
    }


    public function show($noktp)
    {
        // dd($anggota);
        $anggota = Anggota::find($noktp);
        return view('anggota.show',[
            "anggota" => $anggota,
        ]);
    }

    public function changeStatus(Request $request)
    {
        $noktp = $request->input('noktp');
        $anggota = Anggota::find($noktp);

        if ($anggota->status){
            $anggota->status = 0;
            $message = 'Anggota Bernama '. $anggota->nama .' Berhasil Dihapus Dari Daftar Anggota';
        } else {
            $anggota->status = 1;
            $message = 'Pendaftar Bernama '. $anggota->nama .' Berhasil Ditambahkan Sebagai Anggota';
        }
        $anggota->save();

        return back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus($noktp)
    {
        $anggota = Anggota::where("noktp",$noktp)->first();
        Storage::delete($anggota->file_ktp);

        Anggota::where('noktp',$anggota->noktp)->delete();
        User::where('email',$anggota->email)->delete();

        return back()->with('success', 'Pendaftar Berhasil Dihapus');
    }

    public function viewAnggota(Request $request)
    {
        $data_anggota = Anggota::get();

        if ($request->index == 1){
            $anggota = $data_anggota->where('status', 1);
        } else {
            $anggota = $data_anggota->where('status', 0);
        }
        $view = view('anggota.ajax.show_keanggotaan')->with([
            'anggota' => $anggota,
            'index' => $request->index
        ])->render();

        return response()->json(['html' => $view]);
    }

    public function resetPassword($noktp)
    {
        $anggota = Anggota::find($noktp);
        $user = $anggota->user;
        $anggota->password = bcrypt("password");
        $anggota->save();
        $user->password = bcrypt("password");
        $user->save();

        return back()->with('success', 'Password Anggota Berhasil Direset');
    }
}
