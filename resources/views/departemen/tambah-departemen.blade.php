@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-departemen') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="M">Departemen</label>
                            <input type="text" name="departemen" placeholder="Masukan departemen"
                                value="{{ old('departemen') }}" autofocus
                                class="form-control 
                            @error('departemen')
                                is-invalid
                            @enderror">
                            @error('departemen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="M">Deskripsi</label>
                            <input type="text" name="deskripsi" placeholder="Masukan Deskripsi"
                                value="{{ old('deskripsi') }}" autofocus
                                class="form-control 
                            @error('deskripsi')
                                is-invalid
                            @enderror">
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('departemen') }}" class="btn btn-primary btn-block">Batal</a>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
