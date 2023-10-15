<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Buku::selectRaw('*, kategori.nama AS kategori')
        ->join('kategori', 'buku.idkategori', '=', 'kategori.idkategori')
        ->get();

        return view('buku.index',[
            "books" => $books,
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
        return view('add_book',[
            "categories" => Kategori::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|unique:books|regex:/^\d-\d{3}-\d{5}-\d$/',
            'title' => 'required|max:255',
            'categoryid' => 'required',
            'author' => 'required',
            'price' => 'required|numeric'
        ]);

        Buku::create($validatedData);

        return redirect('/books');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $book)
    {
        return view('edit_book',[
            "book" => $book,
            "categories" => Kategori::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $book)
    {
        $rules = [
            'title' => 'required|max:255',
            'categoryid' => 'required',
            'author' => 'required',
            'price' => 'required|numeric'
        ];

        if($request->isbn != $book->isbn){
            $rules['isbn'] = 'required|unique:books|regex:/^\d-\d{3}-\d{5}-\d$/';
        }

        $validatedData = $request->validate($rules);

        Buku::where('isbn',$book->isbn)->update($validatedData);

        return redirect('/books');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $book)
    {
        Buku::where('isbn',$book->isbn)->delete();
        
        return redirect('/books');
    }
}
