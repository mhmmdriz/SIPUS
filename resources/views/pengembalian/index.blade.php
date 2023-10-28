@extends('layouts.main')

@section('container')
    <!-- Tambahkan pesan sukses jika ada -->
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tambahkan pesan kesalahan jika ada -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

<h3>Pengembalian Buku</h3>
<hr>

<nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item active">
        <a role="button" class="page-link" onclick="showPengembalian(1)">Daftar Peminjaman</a>
      </li>
      <li class="page-item">
        <a role="button" class="page-link" onclick="showPengembalian(2)">Daftar Pengembalian</a>
      </li>
    </ul>
</nav>

<!-- Tambahkan search bar di sini -->
{{-- <div class="form-group mb-3 col-md-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Cari ID Transaksi">
</div> --}}

<!-- Hasil pencarian akan ditampilkan di sini -->

<div id="viewPengembalian" class="table-responsive"></div>

<script src="js/ajax_pengembalian.js"></script>
                    
@endsection
