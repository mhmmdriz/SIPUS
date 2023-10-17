@extends('layouts.main')

@section('container')

<h3>Data Buku</h3>
<hr>

<a  class="btn btn-primary mb-4" href="/buku/create">+ Tambah Data Buku</a>

<table class="table table-striped">
  <tr>
    <th>No</th>
    <th>ISBN</th>
    <th>Judul</th>
    <th>Kategori</th>
    <th>Pengarang</th>
    <th>Penerbit</th>
    <th>Action</th>
  </tr>
  
  @php
    $i = 1;
  @endphp

  @foreach ($books as $book)
    <tr>
      <td>{{ $i }}</td>
      <td>{{ $book->isbn }}</td>
      <td>{{ $book->judul }}</td>
      <td>{{ $book->kategori }}</td>
      <td>{{ $book->pengarang }}</td>
      <td>{{ $book->penerbit }}</td>
      <td>
        <a class="btn btn-primary btn-sm" href="/buku/{{ $book->isbn }}">Detail</a>
        <a class="btn btn-warning btn-sm" href="/buku/{{ $book->isbn }}/edit">Edit</a>
        <form action="/buku/{{ $book->isbn }}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
            Delete
          </button>
        </form>
      </td>
    </tr>
    @php
      $i++;
    @endphp
  @endforeach
</table>
<br>
<p>Total Rows = {{ $i-1 }}</p>


@endsection

