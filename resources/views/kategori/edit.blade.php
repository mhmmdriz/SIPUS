@extends('layouts.main')

@section('container')
<h3>Edit Data Kategori</h3>
<hr>
<div class="row">
    <div class="col-md-auto col-sm-auto col-xs-auto">
        <a href="/kategori" class="btn btn-secondary">
            <i class="bi bi-arrow-left"> </i>
            Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 my-3">
        <div class="card">
            <div class="card-body">
                <form action="/kategori/{{ $kategori->idkategori }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}">
                        @error('nama')
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