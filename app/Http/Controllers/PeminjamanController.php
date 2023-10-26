<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;


class PeminjamanController extends Controller
{
    public function index()
    {
        // Retrieve a list of available books
        $availableBooks = Buku::where('stok_tersedia', '>', 0)->get();

        return view('peminjaman.index', compact('availableBooks'));
    }

    public function showBorrowForm($id)
    {
        // Retrieve book details for borrowing
        $book = Buku::findOrFail($id);

        return view('peminjaman.borrow', compact('book'));
    }

    public function borrowBook(Request $request)
    {
        // Validate the request
        $request->validate([
            'book_id' => 'required',
        ]);

        // Check if the user is eligible to borrow (e.g., maximum 2 books per user)
        $user = Auth::user();

        $borrowedBooksCount = Peminjaman::where('noktp', $user->noktp)->count();
        
        if ($borrowedBooksCount >= 2) {
            return redirect()->back()->with('error', 'Anda sudah meminjam maksimal 2 buku.');
        }

        // Check if the selected book is available
        $book = Buku::findOrFail($request->input('book_id'));

        if ($book->stok_tersedia === 0) {
            return redirect()->back()->with('error', 'Maaf, buku ini tidak tersedia saat ini.');
        }

        // Create a new borrowing transaction
        $peminjaman = new Peminjaman();
        $peminjaman->noktp = $user->noktp;
        $peminjaman->idbuku = $request->input('book_id');
        $peminjaman->tgl_pinjam = now();
        $peminjaman->save();

        // Update book availability
        $book->stok_tersedia--;
        $book->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil.');
    }
}
