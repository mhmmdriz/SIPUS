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
            <form method="post" action="{{ url('/pengembalian/kembalikan') }}" class="d-inline">
              @csrf
              <input type="hidden" name="idtransaksi" value="{{ $ts->idtransaksi }}">
              <input type="hidden" name="idbuku" value="{{ $ts->idbuku }}">
              <button type="submit" class="btn btn-primary btn-sm mb-1">Terima Pengembalian</button>
            </form>

            <form action="/peminjaman/hapus/{{ $ts->idtransaksi }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">
                Hapus Permanen
              </button>
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
              <button type="submit" class="btn btn-danger btn-sm mb-1">Batalkan Pengembalian</button>
            </form>
          </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>