<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
// use App\Http\Requests\StoreKategoriRequest;
// use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $categories = Kategori::selectRaw('kategori.idkategori, kategori.nama, COUNT(buku.idbuku) AS total_buku')
        ->where('nama', 'like', '%'.$search.'%')
        ->leftJoin('buku', 'buku.idkategori', '=', 'kategori.idkategori')
        ->groupBy('kategori.idkategori', 'kategori.nama');

        return view('kategori.index',[
            "categories" => $categories->paginate(5)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
        ]);

        Kategori::create($validatedData);

        return redirect('/kategori')->with('success','Data Kategori Berhasil Disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit',[
            "kategori" => $kategori,
            "categories" => Kategori::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
        ]);

        Kategori::where('idkategori',$kategori->idkategori)->update($validatedData);

        return redirect('/kategori')->with('success','Data Kategori Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::where('idkategori',$kategori->idkategori)->delete();
        
        return redirect('/kategori')->with('success','Data Kategori Berhasil Dihapus');
    }
}
