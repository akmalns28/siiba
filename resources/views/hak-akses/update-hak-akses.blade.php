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
                    <form action="{{ route('update-hak-akses', $data->id) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Level</label>
                            <input type="number" name="level" placeholder="Masukan Level" autofocus
                                value="{{ $data->level }}" class="form-control" required="" disabled>
                            <div class="invalid-feedback">
                                Level tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <input type="text" name="hak_akses" placeholder="Masukan Hak Akses" autofocus
                                value="{{ $data->hak_akses}}" class="form-control" required="">
                            <div class="invalid-feedback">
                                Hak akses tidak boleh kosong
                            </div>
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <button class="btn btn-primary btn-block" type="cancel"
                                    onclick="history.back(-1)">Cancel</button>
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
