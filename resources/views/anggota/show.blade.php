@extends('layouts.main')

@section('container')

<h3>Detail Anggota</h3>
<hr>
<a href="/anggota" class="btn btn-secondary mb-3">
  Kembali
</a>

<div class="card">
  <div class="card-header">
    <h5>{{ $anggota->nama }}</h5>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-auto">
        <img class="gambar-ktp" src="{{ asset('storage/' .$anggota->file_ktp) }}" alt="">
      </div>
      <div class="col-md-auto row">
        <div class="col-md-auto me-5">
          <h5>Nomor KTP</h5>
          <p>{{ $anggota->noktp }}</p>
          <h5>Password</h5>
          <p>{{ "<hidden>" }}</p>
          <h5>Alamat</h5>
          <p>{{ $anggota->alamat }}</p>
          <h5>Kota</h5>
          <p>{{ $anggota->kota }}</p>
        </div>
        <div class="col-md-auto">
          <h5>Email</h5>
          <p>{{ $anggota->email }}</p>
          <h5>Nomor Telepon</h5>
          <p>{{ $anggota->no_telp }}</p>
          <h5>Status</h5>
          <p>{{ $anggota->status }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

