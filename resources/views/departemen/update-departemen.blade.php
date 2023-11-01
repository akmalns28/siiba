@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-departemen', $data->id) }}" method="post" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Departemen</label>
                            <input type="text" name="departemen" placeholder="Masukan Departemen"
                                value="{{ $data->departemen }}"
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
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" placeholder="Masukan Deskripsi"
                                value="{{ $data->deskripsi }}"
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
