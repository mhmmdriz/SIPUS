@extends('layouts.main')

@section('container')

<h3>Daftar Transaksi</h3>
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
            </tr>
            @endif
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
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            @if (!$p->detailTransaksi->first()->tgl_kembali && now()->diffInDays($p->tgl_pinjam) <= 14)
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
            </tr>
            @endif
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
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            @if (!$p->detailTransaksi->first()->tgl_kembali && now()->diffInDays($p->tgl_pinjam) > 14)
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
                        @php
                            $extraDenda = now()->diffInDays($p->tgl_pinjam) - 14;
                            $denda = $detailTransaksi->denda + ($extraDenda * 1000);
                        @endphp
                        {{ number_format($denda, 0, ",", ".") }}
                    @endforeach
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>


@endsection
