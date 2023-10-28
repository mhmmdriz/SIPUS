<table class="table table-striped">
  <thead>
    <tr>
      <th>ID Transaksi</th>
      <th>No. KTP</th>
      <th>Judul Buku</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
      <th>Denda</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @if ($index == 1)
      @foreach($transaksi as $ts)
        <tr class="peminjaman-row" data-idtransaksi="{{ $ts->idtransaksi }}">
          <td>{{ $ts->idtransaksi }}</td>
          <td>{{ $ts->noktp }}</td>
          <td>{{ $buku[$ts->idbuku] }}</td>
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
    @else
      @foreach($transaksi as $ts)
        <tr class="peminjaman-row" data-idtransaksi="{{ $ts->idtransaksi }}">
          <td>{{ $ts->idtransaksi }}</td>
          <td>{{ $ts->noktp }}</td>
          <td>{{ $buku[$ts->idbuku] }}</td>
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
    @endif
  </tbody>
</table>