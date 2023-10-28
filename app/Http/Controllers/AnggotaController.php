<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnggotaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($noktp)
    {
        // dd($anggota);
        $anggota = Anggota::find($noktp);
        return view('anggota.show',[
            "anggota" => $anggota,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnggotaRequest $request, Anggota $anggota)
    {
        //
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
    public function destroy(Anggota $anggota)
    {
        //
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
}
