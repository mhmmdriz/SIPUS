<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Peminjaman</div>

                    <div class="card-body">
                        <!-- Tambahkan search bar di sini -->
                        <div class="form-group">
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
                            <table class="table table-bordered">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Integrasi JavaScript untuk Ajax -->
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const searchResult = document.getElementById("searchResult");

        // Fungsi untuk mengirim permintaan pencarian dengan Ajax
        function searchTransactions() {
            const idtransaksi = searchInput.value;

            if (idtransaksi) {
                // Sembunyikan semua baris tabel
                const rows = document.getElementsByClassName("peminjaman-row");
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = "none";
                }

                // Tampilkan baris yang sesuai dengan hasil pencarian
                const matchingRows = document.querySelectorAll(".peminjaman-row[data-idtransaksi='" + idtransaksi + "']");
                for (let i = 0; i < matchingRows.length; i++) {
                    matchingRows[i].style.display = "table-row";
                }
            } else {
                // Tampilkan semua baris tabel jika input pencarian kosong
                const rows = document.getElementsByClassName("peminjaman-row");
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = "table-row";
                }
            }
        }

        // Merekam perubahan pada input pencarian
        searchInput.addEventListener("input", searchTransactions);
    });
    </script>
    </body>
</html>
