@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-user', $data->id) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Masukan Nama" 
                                value="{{ $data->name}}" class="form-control 
                                @error('name')
                                    is-invalid    
                                @enderror" >
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message }}
                                </div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Masukan Username" 
                                value="{{ $data->username}}" class="form-control 
                                @error('username')
                                    is-invalid    
                                @enderror" >
                                @error('username')
                                <div class="invalid-feedback">
                                    {{$message }}
                                </div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="hak_akses_id">
                                @foreach ($hak_akses as $index =>$hk )
                                <option value="{{ $hk->id }}">{{ $hk->hak_akses }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('user') }}"  class="btn btn-primary btn-block">Cancel</a>
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
