@extends('layout.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('container')
    {{-- <div class="">
        <div class="row px-4 pt-2">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Barang</h4>
                        </div>
                        <div class="card-body">
                            {{ count($data) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Barang Tetap</h4>
                        </div>
                        <div class="card-body">
                            {{ $cBarangTetap }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Barang Sekali Pakai</h4>
                        </div>
                        <div class="card-body">
                            {{ $cBarangSekaliPakai }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Stok</h4>
                        </div>
                        <div class="card-body">
                            {{ $sStok }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header">
            <h4>{{ $header }}</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                    @if (Auth::check() && Auth::user()->hak_akses_id == '1')
                        <a href="{{ route('tambah-barang') }}" class="btn btn-primary ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                            </svg>Tambah Data
                        </a>
                    @endif
                    <a href="{{ route('export-pdf-barang') }}" class="btn btn-primary">Export PDF</a>
                    {{-- <button type="button" class="btn btn-primary">Export Excel</button> --}}
                </div>
            </div>

            <div class="row align-items-center mb-4 ">
                <div class="col-sm-12 col-md-4">
                    <form action="{{ route('barang') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <div class="clear-input-container">
                                <input class="clear-input form-control" name="search" type="text"
                                    placeholder="Cari {{ $tittle }}..">
                                <button type="button" class="clear-input-button" aria-label="Clear input"
                                    title="Clear input">×</button>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary " type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive text-wrap">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Kategori Barang</th>
                            <th scope="col">Sub Kategori Barang</th>
                            <th scope="col">Aset</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="7">
                                    <div class="col-sm-12 col-md-12 text-center">
                                        {{ $kosong }}
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($data as $index => $barang)
                                <tr>
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>
                                        <img src="{{ asset('foto-barang/' . $barang->foto) }}"
                                            alt="" style="width: 60px;">
                                    </td>
                                    <td>{{ $barang->kategori->kategori }}</td>
                                    <td>{{ $barang->sub_kategori->sub_kategori }}</td>
                                    <td>{{ $barang->aset }}</td>
                                    <td>{{ $barang->satuan->satuan }}</td>
                                    <td>{{ $barang->stok }}</td>
                                    <td>
                                        <a href="{{ route('tampil-barang', $barang->sub_kategori_id) }}"
                                            class="btn btn-icon btn-sm btn-primary">
                                            Edit
                                        </a>
                                        <a href="{{ route('detail-barang', $barang->sub_kategori_id) }}"
                                            class="btn btn-icon btn-sm btn-primary">
                                            Detail
                                        </a>                                   
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $data->links() }}
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/app.js') }}"></script>
    @endpush
@endsection
