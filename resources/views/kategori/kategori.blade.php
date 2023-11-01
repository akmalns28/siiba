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
            <div class="row align-items-center justify-content-between mb-4 ">
                <div class="col-sm-6 col-md-5 ">
                    <form action="{{ route('kategori') }}" method="GET" class="d-flex">
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
                <div class="col-sm-6 col-md-auto">
                    <a href="{{ route('tambah-kategori') }}" class="text-white " style="text-decoration: none;">
                        <button class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                            </svg>Tambah Data
                        </button>
                    </a>
                </div>
            </div>
            <div class="table-responsive text-wrap">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Kategori</th>
                            <th scope="col">Kategori</th>
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
                            @foreach ($data as $index => $kategori)
                                <tr>
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>{{ $kategori->kode_kategori }}</td>
                                    <td>{{ $kategori->kategori }}</td>
                                    <td>
                                        <div class="button">
                                            <a href="{{ route('tampil-kategori', $kategori->id) }}"
                                                class="btn btn-icon btn-sm btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 16 16">
                                                    <path fill="currentColor"
                                                        d="M13.44 2.56a1.914 1.914 0 0 0-2.707 0L3.338 9.956a1.65 1.65 0 0 0-.398.644l-.914 2.743a.5.5 0 0 0 .632.633l2.743-.915c.243-.08.463-.217.644-.398l7.395-7.394a1.914 1.914 0 0 0 0-2.707Zm-2 .708a.914.914 0 1 1 1.293 1.293L12 5.294l-1.293-1.293l.734-.733ZM10 4.708l1.292 1.293l-5.954 5.954a.648.648 0 0 1-.253.157l-1.794.598l.598-1.794a.649.649 0 0 1 .156-.254L10 4.709Z" />
                                                </svg> </a>
                                            <a href="#" class="btn btn-icon btn-sm btn-primary dlt-kategori"
                                                data-id="{{ $kategori->id }}" data-name="{{ $kategori->kategori }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M10 5h4a2 2 0 1 0-4 0ZM8.5 5a3.5 3.5 0 1 1 7 0h5.75a.75.75 0 0 1 0 1.5h-1.32l-1.17 12.111A3.75 3.75 0 0 1 15.026 22H8.974a3.75 3.75 0 0 1-3.733-3.389L4.07 6.5H2.75a.75.75 0 0 1 0-1.5H8.5Zm2 4.75a.75.75 0 0 0-1.5 0v7.5a.75.75 0 0 0 1.5 0v-7.5ZM14.25 9a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5a.75.75 0 0 1 .75-.75Zm-7.516 9.467a2.25 2.25 0 0 0 2.24 2.033h6.052a2.25 2.25 0 0 0 2.24-2.033L18.424 6.5H5.576l1.158 11.967Z" />
                                                </svg> </a>
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
        <script>
            $('.dlt-kategori').click(function() {
                var idkategori = $(this).attr('data-id');
                var kategori = $(this).attr('data-name');
                Swal.fire({
                    title: 'Apakah Anda Yakin??',
                    text: "Kamu akan menghapus data " + kategori + "",
                    icon: 'warning',
                    showCancelButton: true,
                    buttons: true,
                    dangerMode: true,
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/delete-kategori/" + idkategori + ""
                        Swal.fire(
                            'Deleted!',
                            'Data ' + kategori + ' Telah Dihapus',
                            'success'
                        )
                    }
                });
            });
        </script>
    @endpush
@endsection
