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
                    <form action="{{ route('update-supplier', $data->id) }}" method="post" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="text" name="nama_suplier" placeholder="Masukan Nama Supplier"
                                value="{{ $data->nama }}"
                                class="form-control 
                                @error('nama')
                                    is-invalid    
                                @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" name="no_hp" placeholder="Masukan No HP"
                                value="{{ $data->no_hp }}"
                                class="form-control 
                                @error('no_hp')
                                    is-invalid    
                                @enderror">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="Masukan Alamat"
                                value="{{ $data->alamat }}"
                                class="form-control 
                                @error('alamat')
                                    is-invalid    
                                @enderror">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('departemen') }}" class="btn btn-primary btn-block">Cancel</a>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
