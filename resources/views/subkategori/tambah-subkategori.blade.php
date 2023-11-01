@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-sub-kategori') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="M">Kategori</label>
                            <select
                                class="form-control select2
                            @error('kategori_id')
                                is-invalid
                            @enderror"
                                name="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $index => $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="M">Sub Kategori</label>
                            <input type="text" name="sub_kategori" placeholder="Masukan Sub Kategori"
                                value="{{ old('sub_kategori') }}" autofocus
                                class="form-control 
                            @error('sub_kategori')
                                is-invalid
                            @enderror">
                            @error('sub_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('kategori') }}" class="btn btn-primary btn-block">Batal</a>
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
