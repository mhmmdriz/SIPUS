@extends('layouts.main')

@section('container')

<h3>Riwayat Transaksi</h3>
<hr>

<h3>Transaksi Sudah Selesai</h3>

    <!-- Tabel Daftar Pengembalian -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>No. KTP</th>
                <th>ID Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>ID Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi_selesai as $ts)
                <tr class="peminjaman-row" data-idtransaksi="{{ $ts->idtransaksi }}">
                    <td>{{ $ts->idtransaksi }}</td>
                    <td>{{ $ts->noktp }}</td>
                    <td>{{ $ts->idbuku }}</td>
                    <td>{{ $ts->tgl_pinjam }}</td>
                    <td>{{ $ts->tgl_kembali }}</td>
                    <td>{{ number_format($ts->denda, 0, ",", ".") }}</td>
                    <td>{{ $ts->id_petugas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

<h3>Transaksi Dalam Proses</h3>

    <!-- Tabel Daftar Pengembalian -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>No. KTP</th>
                <th>ID Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>ID Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi_belum_selesai as $ts)
                <tr class="peminjaman-row" data-idtransaksi="{{ $ts->idtransaksi }}">
                    <td>{{ $ts->idtransaksi }}</td>
                    <td>{{ $ts->noktp }}</td>
                    <td>{{ $ts->idbuku }}</td>
                    <td>{{ $ts->tgl_pinjam }}</td>
                    <td>{{ $ts->tgl_kembali }}</td>
                    <td>{{ number_format($ts->denda, 0, ",", ".") }}</td>
                    <td>{{ $ts->id_petugas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

<h3>Transaksi Dalam Proses + Denda</h3>
    <!-- Tabel Daftar Pengembalian -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>No. KTP</th>
                <th>ID Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>ID Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi_belum_selesai_denda as $ts)
                <tr class="peminjaman-row" data-idtransaksi="{{ $ts->idtransaksi }}">
                    <td>{{ $ts->idtransaksi }}</td>
                    <td>{{ $ts->noktp }}</td>
                    <td>{{ $ts->idbuku }}</td>
                    <td>{{ $ts->tgl_pinjam }}</td>
                    <td>{{ $ts->tgl_kembali }}</td>
                    <td>{{ number_format($ts->denda, 0, ",", ".") }}</td>
                    <td>{{ $ts->id_petugas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
