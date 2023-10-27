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

<h3>Daftar Peminjaman</h3>
<br>
    <!-- Tambahkan search bar di sini -->
    <div class="form-group mb-3 col-md-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari ID Transaksi">
    </div>

    <!-- Hasil pencarian akan ditampilkan di sini -->
    <div id="searchResult" class="table-responsive">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>No. KTP</th>
                <th>ID Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>Aksi</th>
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
                    <td>
                        <form method="post" action="{{ url('/pengembalian/kembalikan') }}">
                            @csrf
                            <input type="hidden" name="idtransaksi" value="{{ $ts->idtransaksi }}">
                            <input type="hidden" name="idbuku" value="{{ $ts->idbuku }}">
                            <button type="submit" class="btn btn-primary">Terima Pengembalian</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

<h3>Daftar Pengembalian</h3>
<br>
    <!-- Tabel Daftar Pengembalian -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>No. KTP</th>
                    <th>ID Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Aksi</th>
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
                    <td>
                        <form method="post" action="{{ url('/pengembalian/batal') }}">
                            @csrf
                            <input type="hidden" name="idtransaksi" value="{{ $ts->idtransaksi }}">
                            <input type="hidden" name="idbuku" value="{{ $ts->idbuku }}">
                            <button type="submit" class="btn btn-danger">Batalkan Pengembalian</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
