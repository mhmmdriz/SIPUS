@extends('layouts.main')

@section('container')
<h3>Daftar Peminjaman</h3>
<br>
    <!-- Tambahkan search bar di sini -->
    <div class="form-group mb-3 col-md-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari ID Transaksi">
    </div>

    <!-- Tambahkan pesan sukses jika ada -->
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <!-- Tambahkan pesan kesalahan jika ada -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <!-- Hasil pencarian akan ditampilkan di sini -->
    <div id="searchResult">
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
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


