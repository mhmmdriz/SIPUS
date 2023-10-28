@extends('layouts.main')

@section('container')

<h3>Riwayat Transaksi</h3>
<hr>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item active">
      <a role="button" class="page-link" onclick="showTabelTransaksi(1)">Transaksi Sudah Selesai</a>
    </li>
    <li class="page-item">
      <a role="button" class="page-link" onclick="showTabelTransaksi(2)">Transaksi Dalam Proses</a>
    </li>
    <li class="page-item">
      <a role="button" class="page-link" onclick="showTabelTransaksi(3)">Transaksi Dalam Proses + Denda</a>
    </li>
  </ul>
</nav>

<div id="viewTransactionTable" class="table-responsive"></div>

<script src="js/ajax_transaksi.js"></script>

@endsection
