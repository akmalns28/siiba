@extends('layout.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>{{ $header }}</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                    <a href="{{ route('tambah-barang-masuk') }}" class="btn btn-primary ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                        </svg>Tambah Data
                    </a>
                    <a href="{{ route('export-pdf-barang-masuk') }}" class="btn btn-primary">Export PDF</a>
                    {{-- <button type="button" class="btn btn-primary">Export Excel</button> --}}
                </div>
            </div>
            <div class="row align-items-center mb-4 ">
                <div class="col-sm-12 col-md-4">
                    <form action="{{ route('barang-masuk') }}" method="GET" class="d-flex">
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
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Sumber Dana</th>
                            <th scope="col">Tanggal Masuk</th>
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
                            @foreach ($data as $index => $brg_masuk)
                                <tr>
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>{{ $brg_masuk->kode_barang_masuk }}</td>
                                    <td>{{ $brg_masuk->supplier->nama_suplier }}</td>
                                    <td>{{ $brg_masuk->dana->dana }}</td>
                                    <td>{{ $brg_masuk->tgl_masuk_barang }}</td>
                                    <td>
                                        <div class="button">
                                            <a href="{{ route('detail-barang-masuk', $brg_masuk->id) }}"
                                                class="btn btn-icon btn-sm btn-primary">
                                                Detail
                                            </a>
                                        </div>
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
