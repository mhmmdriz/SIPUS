<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th>No</th>
      <th>No KTP</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Kota</th>
      <th>Email</th>
      <th>No Telp</th>
      <th>Aksi</th>
    </tr>
    
    @php
      $i = 0;
    @endphp
    @if ($index == 1)
      @foreach ($anggota as $ang)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $ang->noktp }}</td>
          <td>{{ $ang->nama }}</td>
          <td>{{ $ang->alamat }}</td>
          <td>{{ $ang->kota }}</td>
          <td>{{ $ang->email }}</td>
          <td>{{ $ang->no_telp }}</td>
          <td>
            <button type="button" class="btn btn-danger btn-sm mb-1 delete-anggota-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-member-noktp="{{ $ang->noktp }}" data-member-name="{{ $ang->nama }}">Hapus</button>
    
            <a class="btn btn-secondary btn-sm mb-1" href="/anggota/{{ $ang->noktp }}">Detail</a>
            <a class="btn btn-warning btn-sm mb-1" href="/anggota/reset/{{ $ang->noktp }}">Reset Password</a>
          </td>
        </tr>
      @endforeach
    @else
      @foreach ($anggota as $ang)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $ang->noktp }}</td>
          <td>{{ $ang->nama }}</td>
          <td>{{ $ang->alamat }}</td>
          <td>{{ $ang->kota }}</td>
          <td>{{ $ang->email }}</td>
          <td>{{ $ang->no_telp }}</td>
          <td>
            <form method="post" action="{{ url('/anggota/change-status') }}" class="d-inline">
              @csrf
              <input type="hidden" name="noktp" value="{{ $ang->noktp }}">
              <button type="submit" class="btn btn-primary btn-sm mb-1">Terima</button>
              <a class="btn btn-warning btn-sm mb-1" href="/anggota/{{ $ang->noktp }}">Detail</a>
            </form>
            <form action="/pendaftar/hapus/{{ $ang->noktp }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">
                Hapus Permanen
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    @endif
  </table>
</div>
<p>Total Rows = {{ $i }}</p>