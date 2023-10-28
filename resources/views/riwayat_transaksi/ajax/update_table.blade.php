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
        @foreach($daftar_transaksi as $ts)
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