@extends('layouts.main')

@section('container')

<h3>Detail Buku</h3>
<hr>
<a href="/buku" class="btn btn-success mb-3">
  Kembali
</a>

<div class="card">
  <div class="card-header">
    <h5>{{ $book->judul }}</h5>
  </div>
  <div class="card-body">
      <h5>ISBN</h5>
      <p>{{ $book->isbn }}</p>
      <h5>Kategori</h5>
      <p>{{ $book->kategori->nama }}</p>
      <h5>Pengarang</h5>
      <p>{{ $book->pengarang }}</p>
      <h5>Penerbit</h5>
      <p>{{ $book->penerbit }}</p>
      <br>
  </div>
</div>
@endsection

