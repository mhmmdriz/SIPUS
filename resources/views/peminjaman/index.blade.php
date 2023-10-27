@extends('layouts.main')

@section('container')
<h3>Tambah Data Buku</h3>
<hr>

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="row d-flex justify-content-center">
  <div class="col-md-12 my-3">
      <div class="card">
          <div class="card-body">
              <form action="/peminjaman" method="POST">
                  @csrf
                  <div class="mb-3">
                      <label for="noktp" class="form-label">Anggota</label>
                      <select class="form-control @error('noktp') is-invalid @enderror" id="noktp" name="noktp">
                        <option selected disabled>Pilih Anggota</option>
                        @foreach ($anggota_belum_meminjam as $anggota)
                            @if (old('noktp') == $anggota->noktp)
                                <option value="{{ $anggota->noktp }}" selected>{{ $anggota->nama }}</option>
                            @else
                                <option value="{{ $anggota->noktp }}">{{ $anggota->nama }}</option>
                            @endif
                        @endforeach
                        @foreach ($anggota_belum_mengembalikan as $anggota)
                          <option value="{{ $anggota->noktp }}" disabled>{{ $anggota->nama }}</option>
                        @endforeach
                    </select>
                      @error('noktp')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                  <div class="mb-3">
                    <label for="judul" class="form-label">Buku</label>
                    <br>
                    <select class="form-select multi-select @error('idbuku') is-invalid @enderror" id="idbuku" name="idbuku[]" multiple="multiple" style="width: 100%">
                        @foreach ($buku as $b)
                            @if (is_array(old('idbuku')) && in_array($b->idbuku, old('idbuku')))
                                <option value="{{ $b->idbuku }}" selected>{{ $b->judul }}</option>
                            @else
                                <option value="{{ $b->idbuku }}">{{ $b->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('idbuku')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                
                  <button type="submit" class="btn btn-primary" name="submit">Tambah Data</button>
              </form>
          </div>
      </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#idbuku').select2({});
});
</script>
@endsection