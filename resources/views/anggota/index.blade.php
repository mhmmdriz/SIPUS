@extends('layouts.main')

@section('container')

<h3>Pendaftar</h3>
<hr>

<div class="overflow-auto">
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
    <th>Status</th>
    <th>Terima?</th>
  </tr>
  
  @php
    $i = 0;
  @endphp

  @foreach ($applicants as $applicant)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $applicant->noktp }}</td>
      <td>{{ $applicant->nama }}</td>
      <td>{{ $applicant->password }}</td>
      <td>{{ $applicant->alamat }}</td>
      <td>{{ $applicant->kota }}</td>
      <td>{{ $applicant->email }}</td>
      <td>{{ $applicant->no_telp }}</td>
      <td>{{ $applicant->file_ktp }}</td>
      <td>{{ $applicant->status }}</td>
      <td>
        <a class="btn btn-primary btn-sm" href="{{ url('change-status/'.$applicant->noktp) }}">Terima</a>
      </td>
    </tr>

  @endforeach
</table>
</div>
<p>Total Rows = {{ $i }}</p>

<br>

<h3>Daftar Anggota</h3>
<hr>

<div class="overflow-auto">
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
    <th>Status</th>
    <th>Hapus Keanggotaan?</th>
  </tr>
  
  @php
    $i = 0;
  @endphp

  @foreach ($members as $member)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $member->noktp }}</td>
      <td>{{ $member->nama }}</td>
      <td>{{ $member->password }}</td>
      <td>{{ $member->alamat }}</td>
      <td>{{ $member->kota }}</td>
      <td>{{ $member->email }}</td>
      <td>{{ $member->no_telp }}</td>
      <td>{{ $member->file_ktp }}</td>
      <td>{{ $member->status }}</td>
      <td>
        <a class="btn btn-danger btn-sm" href="{{ url('change-status/'.$member->noktp) }}" onclick="return confirm('Are you sure?')">Hapus</a>
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

@endsection

