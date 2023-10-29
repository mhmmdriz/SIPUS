<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $books = Buku::selectRaw('*, kategori.nama AS kategori')
        ->join('kategori', 'buku.idkategori', '=', 'kategori.idkategori')
        ->where('judul', 'like', '%'.$search.'%')
        ->orWhere('isbn', 'like', '%'.$search.'%')
        ->orWhere('kategori.nama', 'like', '%'.$search.'%')
        ->orWhere('pengarang', 'like', '%'.$search.'%')
        ->orWhere('penerbit', 'like', '%'.$search.'%')
        ->orWhere('kota_terbit', 'like', '%'.$search.'%')
        ->orWhere('editor', 'like', '%'.$search.'%')
        ;
        
        $bukuPernahDipinjam = [];
        $bukuPernahDipinjam = DetailTransaksi::whereIn('idbuku', $books->pluck('idbuku'))->pluck('idbuku', 'idbuku')->toArray();

        return view('buku.index',[
            "books" => $books->paginate(5)->withQueryString(),
            'bukuPernahDipinjam' => $bukuPernahDipinjam,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        // dd($buku);
        return view('buku.show',[
            "book" => $buku,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create',[
            "categories" => Kategori::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|unique:buku|regex:/^\d-\d{3}-\d{5}-\d$/',
            'judul' => 'required|max:255',
            'idkategori' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kota_terbit' => 'required',
            'editor' => 'required',
            'file_gambar' => 'required',
            'stok' => 'required|numeric|min:1'
        ]);

        $validatedData['stok_tersedia'] = $validatedData['stok'];

        if($request->file('file_gambar')){
            $validatedData['file_gambar'] = $request->file('file_gambar')->store('images');
        }

        Buku::create($validatedData);

        return redirect('/buku')->with('success','Data Buku Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        return view('buku.edit',[
            "buku" => $buku,
            "categories" => Kategori::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $rules = [
            'judul' => 'required|max:255',
            'idkategori' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kota_terbit' => 'required',
            'editor' => 'required',
            'stok' => 'required|numeric|min:0',
            'stok_tersedia' => 'required|numeric|min:0|lte:stok'
        ];

        if($request->isbn != $buku->isbn){
            $rules['isbn'] = 'required|unique:buku|regex:/^\d-\d{3}-\d{5}-\d$/';
        }

        $validatedData = $request->validate($rules);

        if($request->file('file_gambar')){
            if($buku->file_gambar){
                Storage::delete($buku->file_gambar);
            }
            $validatedData['file_gambar'] = $request->file('file_gambar')->store('images');
        }

        Buku::where('isbn',$buku->isbn)->update($validatedData);

        return redirect('/buku')->with('success','Data Buku Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        if($buku->file_gambar){
            Storage::delete($buku->file_gambar);
        }
        
        Buku::where('isbn',$buku->isbn)->delete();
        
        return redirect('/buku')->with('success','Data Buku Berhasil Dihapus');
    }
}
