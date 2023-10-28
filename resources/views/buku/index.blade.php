@extends('layouts.main')

@section('container')

<h3>Data Buku</h3>
<hr>

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<a  class="btn btn-primary mb-4" href="/buku/create">+ Tambah Data Buku</a>

<div class="row">
  <div class="col-6">
    <form action="/buku">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search...." name="search" value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </form>
  </div>
</div>

<div class="table-responsive">
<table class="table table-striped" id="tabel_buku">
  <tr>
    <th>No</th>
    <th>ISBN</th>
    <th>Judul</th>
    <th>Kategori</th>
    <th>Pengarang</th>
    <th>Penerbit</th>
    <th>Stok Total</th>
    <th>Stok Tersedia</th>
    <th>Action</th>
  </tr>
  
  @php
    $i = ($books->currentPage() - 1) * $books->perPage();
  @endphp

  @foreach ($books as $book)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $book->isbn }}</td>
      <td>{{ $book->judul }}</td>
      <td>{{ $book->kategori }}</td>
      <td>{{ $book->pengarang }}</td>
      <td>{{ $book->penerbit }}</td>
      <td>{{ $book->stok }}</td>
      <td>{{ $book->stok_tersedia }}</td>
      <td>
        <a class="btn btn-primary btn-sm mb-1" href="/buku/{{ $book->isbn }}">Detail</a>
        <a class="btn btn-warning btn-sm mb-1" href="/buku/{{ $book->isbn }}/edit">Edit</a>
        
        <button type="button" class="btn btn-danger btn-sm mb-1 delete-book-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-buku-isbn="{{ $book->isbn }}" data-buku-judul="{{ $book->judul }}">Hapus</button>
        
      </td>
    </tr>
  @endforeach
</table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Buku</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin menghapus buku berjudul <span id="judulBuku"></span> (ISBN: <span id="isbnBuku"></span>)?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" method="post" id="deleteBookForm" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger">
            Delete
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row d-flex justify-content-center">
  <div class="col-auto">
    {{ $books->links() }}
  </div>
</div>
<script src="js/modal_del.js"></script>

@endsection

