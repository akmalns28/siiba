@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>{{ $header }}</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-4">
                    <a href="{{ route('barang') }}" class="btn btn-primary ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="M228 128a12 12 0 0 1-12 12H69l51.52 51.51a12 12 0 0 1-17 17l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z" />
                        </svg>Kembali
                    </a>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary">Export PDF</button>
                        <button type="button" class="btn btn-primary">Export Excel</button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">

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
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Sub Kategori</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">No Inventarisasi</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Pemilik</th>
                            <th scope="col">Di Input</th>
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
                            @php
                                $no = $data->firstItem();
                            @endphp
                            @foreach ($data as $index => $det_brg)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>
                                        <img src="{{ asset('foto-barang/' . $det_brg->detail_barang_masuk->barang->foto) }}"
                                            alt="" style="width: 60px;">
                                    </td>
                                    <td>{{ $det_brg->detail_barang_masuk->nama_barang }}</td>
                                    <td>{{ $det_brg->detail_barang_masuk->barang->kategori->kategori }}</td>
                                    <td>{{ $det_brg->detail_barang_masuk->barang->sub_kategori->sub_kategori }}</td>
                                    <td>{{ $det_brg->kode_barang }}</td>
                                    <td>{{ $det_brg->no_inventarisasi }}</td>
                                    <td>{{ $det_brg->kondisi }}</td>
                                    <td>{{ $det_brg->status }}</td>
                                    <td>{{ $det_brg->detail_barang_masuk->pemilik_id }}</td>
                                    <td>{{ $det_brg->user->name }}</td>
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
        <script>
            $('.dlt-detail-barang').click(function() {
                var iddetail - barang = $(this).attr('data-id');
                var detail - barang = $(this).attr('data-name');
                Swal.fire({
                    title: 'Apakah Anda Yakin??',
                    text: "Kamu akan menghapus data " + detail - barang + "",
                    icon: 'warning',
                    showCancelButton: true,
                    buttons: true,
                    dangerMode: true,
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/delete-detail-barang/" + iddetail - barang + ""
                        Swal.fire(
                            'Deleted!',
                            'Data ' + detail - barang + ' Telah Dihapus',
                            'success'
                        )
                    }
                });
            });
        </script>
    @endpush
@endsection
