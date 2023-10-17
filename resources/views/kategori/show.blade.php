@extends('layouts.main')

@section('container')

<h3>Detail Buku</h3>
<hr>
<a href="/buku" class="btn btn-secondary mb-3">
  Kembali
</a>

<div class="card">
  <div class="card-header">
    <h5>{{ $book->judul }}</h5>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-auto">
        <img class="gambar-buku" src="{{ asset('storage/' . $book->file_gambar) }}" alt="">
      </div>
      <div class="col-md-auto">
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
      <div class="col-md-auto ms-5">
        <h5>Kota Terbit</h5>
        <p>{{ $book->kota_terbit }}</p>
        <h5>Editor</h5>
        <p>{{ $book->editor }}</p>
      </div>
    </div>
  </div>
</div>
@endsection

