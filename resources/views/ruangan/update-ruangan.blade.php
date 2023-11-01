@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-kategori', $data->id) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="kategori" placeholder="Masukan Kategori" 
                                value="{{ $data->kategori}}" class="form-control 
                                @error('kategori')
                                    is-invalid    
                                @enderror" >
                                @error('kategori')
                                <div class="invalid-feedback">
                                    {{$message }}
                                </div>
                                @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('kategori') }}"  class="btn btn-primary btn-block">Cancel</a>
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
