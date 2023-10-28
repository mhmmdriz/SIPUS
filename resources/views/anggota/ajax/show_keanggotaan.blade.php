<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th>No</th>
      <th>No KTP</th>
      <th>Nama</th>
      <th>Password</th>
      <th>Alamat</th>
      <th>Kota</th>
      <th>Email</th>
      <th>No Telp</th>
      <th>File KTP</th>
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
          <td>{{ "<hidden>" }}</td>
          <td>{{ $ang->alamat }}</td>
          <td>{{ $ang->kota }}</td>
          <td>{{ $ang->email }}</td>
          <td>{{ $ang->no_telp }}</td>
          <td>{{ ($ang->file_ktp != NULL) ? "<submitted>":"<unsubmitted>" }}</td>
          <td>
            <button type="button" class="btn btn-danger btn-sm mb-1 delete-anggota-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-member-noktp="{{ $ang->noktp }}" data-member-name="{{ $ang->nama }}">Hapus</button>
    
            <a class="btn btn-warning btn-sm mb-1" href="/anggota/{{ $ang->noktp }}">Detail</a>
          </td>
        </tr>
      @endforeach
    @else
      @foreach ($anggota as $ang)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $ang->noktp }}</td>
          <td>{{ $ang->nama }}</td>
          <td>{{ "<hidden>" }}</td>
          <td>{{ $ang->alamat }}</td>
          <td>{{ $ang->kota }}</td>
          <td>{{ $ang->email }}</td>
          <td>{{ $ang->no_telp }}</td>
          <td>{{ ($ang->file_ktp != NULL) ? "<submitted>":"<unsubmitted>" }}</td>
          <td>
            <form method="post" action="{{ url('/anggota/change-status') }}">
              @csrf
              <input type="hidden" name="noktp" value="{{ $ang->noktp }}">
              <button type="submit" class="btn btn-primary btn-sm mb-1">Terima</button>
            </form>
            <a class="btn btn-warning btn-sm mb-1" href="/anggota/{{ $ang->noktp }}">Detail</a>
            {{-- <form action="/anggota/{{ $ang->noktp }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                Hapus
              </button>
            </form> --}}
          </td>
        </tr>
      @endforeach
    @endif
  </table>
</div>
<p>Total Rows = {{ $i }}</p>