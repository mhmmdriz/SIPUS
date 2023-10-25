@extends('layouts.main')

@section('container')

<h3>Data Kategori</h3>
<hr>

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show col-md-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<a  class="btn btn-primary mb-4" href="/kategori/create">+ Tambah Data Kategori</a>
<div class="row">
  <div class="col-md-6 overflow-auto">

    <table class="table table-striped" id="tabel_kategori">
      <tr>
        <th>No</th>
        <th>Kategori</th>
        <th>Total Buku (Per Judul)</th>
        <th>Action</th>
      </tr>
      
      @php
        $i = 0;
      @endphp
    
      @foreach ($categories as $category)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $category->nama }}</td>
          <td>{{ $category->total_buku }}</td>
          <td>
            <a class="btn btn-warning btn-sm" href="/kategori/{{ $category->idkategori }}/edit">Edit</a>
            @if ($category->total_buku == 0)
              <form action="/kategori/{{ $category->idkategori }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                  Delete
                </button>
              </form>
            @endif
          </td>
        </tr>
      @endforeach
    </table>
    <br>
    <p>Total Rows = {{ $i }}</p>
  </div>
</div>


@endsection

