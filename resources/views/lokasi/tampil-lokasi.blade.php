@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-kategori', $data->id) }}" method="post">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" value="{{ $data->kategori }}" name="kategori"
                                    placeholder="Masukan kategori" class="form-control">
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-primary ">Simpan</button>
                                <button type="cancel" onclick="history.back(-1)" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
