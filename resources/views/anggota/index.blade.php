@extends('layouts.main')

@section('container')

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<h3>Keanggotaan</h3>
<hr>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item active">
      <a role="button" class="page-link" onclick="showAnggota(1)">Anggota</a>
    </li>
    <li class="page-item">
      <a role="button" class="page-link" onclick="showAnggota(2)">Pendaftar</a>
    </li>
  </ul>
</nav>

<div id="viewAnggota" class="table-responsive"></div>

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

<script src="js/modal_del.js"></script>
<script src="js/ajax_anggota.js"></script>

@endsection
