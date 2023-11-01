@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-satuan', $data->id) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" placeholder="Masukan Satuan" 
                                value="{{ $data->satuan}}" class="form-control 
                                @error('satuan')
                                    is-invalid    
                                @enderror" >
                                @error('satuan')
                                <div class="invalid-feedback">
                                    {{$message }}
                                </div>
                                @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('satuan') }}"  class="btn btn-primary btn-block">Cancel</a>
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
