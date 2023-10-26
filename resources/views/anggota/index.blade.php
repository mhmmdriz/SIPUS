@extends('layouts.main')

@section('container')

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<h3>Pendaftar</h3>
<hr>

<div class="table-responsive">
<table class="table table-striped">
  <tr>
    <th>No</th>
    <th>No KTP</th>
    <th>Nama</th>
    <th>Password</th>
    <th>Alamat</th>
    <th>Kota</th>
    <th>Email</th>
    <th>No Telp</th>
    <th>File KTP</th>
    <th>Aksi</th>
  </tr>
  
  @php
    $i = 0;
  @endphp

  @foreach ($applicants as $applicant)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $applicant->noktp }}</td>
      <td>{{ $applicant->nama }}</td>
      <td>{{ "<hidden>" }}</td>
      <td>{{ $applicant->alamat }}</td>
      <td>{{ $applicant->kota }}</td>
      <td>{{ $applicant->email }}</td>
      <td>{{ $applicant->no_telp }}</td>
      <td>{{ ($applicant->file_ktp != NULL) ? "<submitted>":"<unsubmitted>" }}</td>
      <td>
        <form method="post" action="{{ url('/anggota/change-status') }}">
          @csrf
          <input type="hidden" name="noktp" value="{{ $applicant->noktp }}">
          <button type="submit" class="btn btn-primary btn-sm mb-1">Terima</button>
        </form>
        <a class="btn btn-warning btn-sm mb-1" href="/anggota/{{ $applicant->noktp }}">Detail</a>
      </td>
    </tr>

  @endforeach
</table>
</div>
<p>Total Rows = {{ $i }}</p>

<br>

<h3>Daftar Anggota</h3>
<hr>

<div class="table-responsive">
<table class="table table-striped">
  <tr>
    <th>No</th>
    <th>No KTP</th>
    <th>Nama</th>
    <th>Password</th>
    <th>Alamat</th>
    <th>Kota</th>
    <th>Email</th>
    <th>No Telp</th>
    <th>File KTP</th>
    <th>Aksi</th>
  </tr>
  
  @php
    $i = 0;
  @endphp

  @foreach ($members as $member)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $member->noktp }}</td>
      <td>{{ $member->nama }}</td>
      <td>{{ "<hidden>" }}</td>
      <td>{{ $member->alamat }}</td>
      <td>{{ $member->kota }}</td>
      <td>{{ $member->email }}</td>
      <td>{{ $member->no_telp }}</td>
      <td>{{ ($member->file_ktp != NULL) ? "<submitted>":"<unsubmitted>" }}</td>
      <td>
        <button type="button" class="btn btn-danger btn-sm mb-1 delete-anggota-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-member-noktp="{{ $member->noktp }}" data-member-name="{{ $member->nama }}">Hapus</button>

        <a class="btn btn-warning btn-sm mb-1" href="/anggota/{{ $member->noktp }}">Detail</a>
        {{-- <form action="/anggota/{{ $member->noktp }}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
            Hapus
          </button>
        </form> --}}
      </td>
    </tr>

  @endforeach
</table>
</div>
<p>Total Rows = {{ $i }}</p>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin menghapus <span id="memberName"></span> dari keanggotaan (No KTP: <span id="memberNoktp"></span>)?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="post" action="{{ url('/anggota/change-status') }}">
          @csrf
          <input type="hidden" id="noktp" name="noktp" value="">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="js/modal-del.js"></script>

@endsection

