@extends('layouts.main')

@section('container')
<h3>Tambah Data Kategori</h3>
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
                <form action="/kategori" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
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
@endsection