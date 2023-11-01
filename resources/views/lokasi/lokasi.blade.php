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
                    <a href="{{ route('tambah-lokasi') }}" class="btn btn-primary ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                        </svg>Tambah Data
                    </a>
                    <a href="{{ route('export-pdf-lokasi') }}" class="btn btn-primary">Export PDF</a>                    
                </div>
            </div>
            <div class="row align-items-center mb-4 ">
                <div class="col-sm-12 col-md-4">
                    <form action="{{ route('lokasi') }}" method="GET" class="d-flex">
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
                            <th scope="col">Kode Ruangan</th>
                            <th scope="col">Ruangan</th>
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
                            @foreach ($data as $index => $lokasi)
                                <tr>
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>{{ $lokasi->ruangan->kd_ruangan }}</td>
                                    <td>{{ $lokasi->ruangan->ruangan }}</td>
                                    <td>
                                        <a href="{{ route('detail-lokasi', $lokasi->ruangan_id) }}"
                                            class="btn btn-icon btn-sm btn-primary">
                                            Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="col d-flex justify-content-end">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/app.js') }}"></script>
    @endpush
@endsection
