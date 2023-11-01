@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-dana') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="M">Dana</label>
                            <input type="text" name="dana" placeholder="Masukan dana" value="{{ old('dana') }}" autofocus class="form-control 
                            @error('dana')
                                is-invalid
                            @enderror">
                            @error('dana') 
                            <div class="invalid-feedback">
                                {{$message }}
                            </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('dana') }}"  class="btn btn-primary btn-block">Batal</a>
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
