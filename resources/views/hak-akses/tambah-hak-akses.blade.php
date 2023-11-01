@extends('layout.main')
@push('css')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endpush
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-hak-akses') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="M">Level</label>
                            <input type="number" name="level" placeholder="Masukan Level" autofocus
                                value="{{ old('level') }}" class="form-control 
                                @error('level')
                                    is-invalid
                                @enderror">
                            
                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="M">Hak Akses</label>
                            <input type="text" name="hak_akses" placeholder="Masukan Hak Akses" autofocus
                                value="{{ old('hak_akses') }}"
                                class="form-control 
                                @error('hak_akses')
                                    is-invalid
                                @enderror"
                                >
                            @error('hak_akses')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('hak-akses') }}"  class="btn btn-primary btn-block">Batal</a>
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
