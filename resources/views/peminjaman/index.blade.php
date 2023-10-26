@extends('layouts.main')

@section('container')
<div class="container mt-4">
    <h3>Daftar Peminjaman</h3>

    <!-- Search Bar -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari ID Transaksi">
    </div>

    <!-- Success Message for Peminjaman -->
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message for Peminjaman -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <!-- Table for Peminjaman -->
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
            @foreach($availableBooks as $p)
                @if (!$p->detailTransaksi->first()->tgl_kembali)
                    <tr class="peminjaman-row" data-idtransaksi="{{ $p->idtransaksi }}">
                        <td>{{ $p->idtransaksi }}</td>
                        <td>{{ $p->noktp }}</td>
                        @foreach($p->detailTransaksi as $detailTransaksi)
                            <td>{{ $detailTransaksi->idbuku }}</td>
                        @endforeach
                        <td>{{ $p->tgl_pinjam }}</td>
                        <td>
                            @foreach($p->detailTransaksi as $detailTransaksi)
                                {{ $detailTransaksi->tgl_kembali }}
                            @endforeach
                        </td>
                        <td>
                            @foreach($p->detailTransaksi as $detailTransaksi)
                                {{ number_format($detailTransaksi->denda, 0, ",", ".") }}
                            @endforeach
                        </td>
                        <td>
                            <form method="post" action="{{ url('/pengembalian/kembalikan') }}">
                                @csrf
                                <input type="hidden" name="idtransaksi" value="{{ $p->idtransaksi }}">
                                <button type="submit" class="btn btn-primary">Terima Pengembalian</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <h3>Daftar Pengembalian</h3>

    <!-- Success Message for Pengembalian -->
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message for Pengembalian -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <!-- Table for Pengembalian -->
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
            @foreach($peminjaman as $p)
                @if ($p->detailTransaksi->first()->tgl_kembali)
                    <tr class="peminjaman-row" data-idtransaksi="{{ $p->idtransaksi }}">
                        <td>{{ $p->idtransaksi }}</td>
                        <td>{{ $p->noktp }}</td>
                        @foreach($p->detailTransaksi as $detailTransaksi)
                            <td>{{ $detailTransaksi->idbuku }}</td>
                        @endforeach
                        <td>{{ $p->tgl_pinjam }}</td>
                        <td>
                            @foreach($p->detailTransaksi as $detailTransaksi)
                                {{ $detailTransaksi->tgl_kembali }}
                            @endforeach
                        </td>
                        <td>
                            @foreach($p->detailTransaksi as $detailTransaksi)
                                {{ number_format($detailTransaksi->denda, 0, ",", ".") }}
                            @endforeach
                        </td>
                        <td>
                            <form method="post" action="{{ url('/pengembalian/batal') }}">
                                @csrf
                                <input type="hidden" name="idtransaksi" value="{{ $p->idtransaksi }}">
                                <button type="submit" class="btn btn-danger">Batalkan Pengembalian</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
