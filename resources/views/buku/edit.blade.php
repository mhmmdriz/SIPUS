@extends('layouts.main')

@section('container')
<h3>Edit Data Buku</h3>
<hr>
<div class="row">
    <div class="col-md-auto col-sm-auto col-xs-auto">
        <a href="/buku" class="btn btn-secondary">
            <i class="bi bi-arrow-left"> </i>
            Back
        </a>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-md-12 my-3">
        <div class="card">
            <div class="card-body">
                <form action="/buku/{{ $buku->isbn }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}">
                        @error('isbn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="idkategori" class="form-label">Kategori</label>
                        <select class="form-select @error('idkategori') is-invalid @enderror" aria-label="Default select example" id="idkategori" name="idkategori">
                            <option selected disabled>Pilih kategori</option>
                            @foreach ($categories as $kategori)
                                @if (old('idkategori', $buku->idkategori) == $kategori->idkategori)
                                    <option value="{{ $kategori->idkategori }}" selected>{{ $kategori->nama }}</option>
                                @else
                                    <option value="{{ $kategori->idkategori }}">{{ $kategori->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('idkategori')
                            <div class="invalid-feedback">
                                {{ "The kategori field is required" }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}">
                        @error('pengarang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}">
                        @error('penerbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kota_terbit" class="form-label">Kota Terbit</label>
                        <input type="text" class="form-control @error('kota_terbit') is-invalid @enderror" id="kota_terbit" name="kota_terbit" value="{{ old('kota_terbit', $buku->kota_terbit) }}">
                        @error('kota_terbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editor" class="form-label">Editor</label>
                        <input type="text" class="form-control @error('editor') is-invalid @enderror" id="editor" name="editor" value="{{ old('editor', $buku->editor) }}">
                        @error('editor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="file_gambar" class="form-label">Gambar Cover Buku</label>
                      {{-- untuk preview image --}}

                      @if ($buku->file_gambar)
                        <img src="{{ asset('storage/' . $buku->file_gambar) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                      @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                      @endif

                      <input class="form-control @error('file_gambar') is-invalid @enderror" type="file" id="file_gambar" name="file_gambar" onchange="previewImage()" value="{{ asset('storage/' . $buku->file_gambar) }}">
                      @error('file_gambar')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
        
                    <button type="submit" class="btn btn-primary" name="submit">Update Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection