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
                    <a href="{{ route('tambah-peminjaman') }}" class="btn btn-primary ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                        </svg>Tambah Data
                    </a>
                    <a href="{{ route('export-pdf-peminjaman') }}" class="btn btn-primary">Export PDF</a>
                    {{-- <button type="button" class="btn btn-primary">Export Excel</button> --}}
                </div>
            </div>
            <div class="row align-items-center mb-4 ">
                <div class="col-sm-12 col-md-4">
                    <form action="{{ route('peminjaman') }}" method="GET" class="d-flex">
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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>No Peminjaman</th>
                                <th>Peminjam</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th colspan="2" class="text-center">Aksi</th>
                            </tr>
                            @if ($data->isEmpty())
                                <tr>
                                    <td colspan="7">
                                        <div class="col-sm-12 col-md-12 text-center">
                                            {{ $kosong }}
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($data as $index => $peminjaman)
                                    <tr>
                                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                                        <td>
                                            {{ $peminjaman->no_peminjaman }}
                                        </td>
                                        <td>
                                            {{ $peminjaman->peminjam->nama }}
                                        </td>
                                        <td>{{ $peminjaman->tgl_peminjaman }}</td>
                                        <td>
                                            @if ($peminjaman->tgl_kembali)
                                                <div>{{ $peminjaman->tgl_kembali }}</div>
                                            @else
                                                <div class="badge badge-danger">Belum Dikembalikan</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($peminjaman->detail_barang->status == 'In Stock')
                                                <div class="badge badge-primary status-barang"
                                                    id="statusBarang{{ $peminjaman->id }}">
                                                    {{ $peminjaman->detail_barang->status }}</div>
                                            @else
                                                <div class="badge badge-danger status-barang"
                                                    id="statusBarang{{ $peminjaman->id }}">
                                                    {{ $peminjaman->detail_barang->status }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('update-status', $peminjaman->peminjam_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-icon btn-sm btn-success tombol-selesai">Selesai</button>
                                            </form>
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('detail-peminjaman', $peminjaman->peminjam_id) }}"
                                                class="btn btn-icon btn-sm btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{ $data->links() }}
        </div>

    </div>
    @push('js')
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     var tombolSelesai = document.getElementsByClassName("tombol-selesai");

            //     for (var i = 0; i < tombolSelesai.length; i++) {
            //         var statusDetailBarang = tombolSelesai[i].closest("tr").querySelector(".status-barang").innerText;

            //         if (statusDetailBarang === "In Stock") {
            //             tombolSelesai[i].style.display = "none";
            //         }
            //     }

            //     var tabel = document.querySelector("table");

            //     for (var i = 1; i < tabel.rows.length; i++) {
            //         var tanggalKembali = tabel.rows[i].cells[4].innerText;

            //         if (tanggalKembali !== "Belum Dikembalikan") {
            //             tabel.rows[i].style.display = "none";
            //         }
            //     }
            // });
        </script>
    @endpush
@endsection
