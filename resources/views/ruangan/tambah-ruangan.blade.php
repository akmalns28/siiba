@extends('layout.main')
@push('css')

@endpush
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-ruangan') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="M">Kode Ruangan</label>
                            <input type="text" name="kd_ruangan" placeholder="Masukan Kode Ruangan" value="{{ old('kd_ruangan') }}" autofocus class="form-control 
                            @error('kd_ruangan')
                                is-invalid
                            @enderror">
                            @error('kd_ruangan') 
                            <div class="invalid-feedback">
                                {{$message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="M">Ruangan</label>
                            <input type="text" name="ruangan" placeholder="Masukan Ruangan" value="{{ old('ruangan') }}" class="form-control 
                            @error('ruangan')
                                is-invalid
                            @enderror">
                            @error('ruangan') 
                            <div class="invalid-feedback">
                                {{$message }}
                            </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('kategori') }}"  class="btn btn-primary btn-block">Batal</a>
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
