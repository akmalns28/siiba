@extends('layout.main')
@section('container')
    <div class="container">
        <div id="detailBarang">
            <!-- Menampilkan detail barang -->
            <div class="card">
                <div class="card-header">
                    <h4>{{ $datas->ruangan->kd_ruangan . ' | ' . $datas->ruangan->ruangan }} </h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-4">
                            <a href="{{ route('lokasi') }}" class="btn btn-primary ">
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
                                <button onclick="showEditForm()" class="btn btn-primary">Pindah Lokasi</button>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">

                        </div>
                    </div>
                    <div class="row align-items-center mb-4 ">
                        <div class="col-sm-12 col-md-4">
                            <form action="{{ route('barang') }}" method="GET" class="d-flex">
                                <div class="input-group mb-3">
                                    <input class="form-control" id="floatingInput" name="search" type="search"
                                        placeholder="Search" autocomplete="off" data-width="full">
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
                                    <th scope="col">Kategori Barang</th>
                                    <th scope="col">Sub Kategori Barang</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">No Inventarisasi</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Di Input Oleh</th>
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
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>
                                                <img src="{{ asset('foto-barang/' . $lokasi->detail_barang->barang->foto) }}"
                                                    alt="" style="width: 60px;">
                                            </td>
                                            <td>{{ $lokasi->detail_barang->detail_barang_masuk->nama_barang }}</td>
                                            <td>{{ $lokasi->detail_barang->barang->kategori->kategori }}</td>
                                            <td>{{ $lokasi->detail_barang->barang->sub_kategori->sub_kategori }}</td>
                                            <td>{{ $lokasi->detail_barang->kode_barang }}</td>
                                            <td>{{ $lokasi->detail_barang->no_inventarisasi }}</td>
                                            <td>{{ $lokasi->detail_barang->kondisi }}</td>
                                            <td>{{ $lokasi->detail_barang->status }}</td>
                                            {{-- <td>{{ $lokasi->departemen->departemen }}</td> --}}
                                            <td>{{ $lokasi->user->name }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer">
                    {{ $data->links() }}
                </div> --}}
            </div>
        </div>


        {{-- page pindah  --}}
        <div id="editForm" style="display: none;">
            <!-- Formulir pengeditan -->
            <div class="card">
                <div class="card-header">
                    <h4>{{ 'Ruang' . ' ' . $ruangan }}</h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-4">
                            <a href="{{ route('lokasi') }}" class="btn btn-primary ">
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
                            <form action="{{ route('barang') }}" method="GET" class="d-flex">
                                <input class="form-control" id="floatingInput" name="search" type="search"
                                    placeholder="Search" autocomplete="off" data-width="full">
                                <button class="btn btn-primary " type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-primary " type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <g transform="translate(24 0) scale(-1 1)">
                                            <g fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="13" r="3" />
                                                <path
                                                    d="M9.778 21h4.444c3.121 0 4.682 0 5.803-.735a4.408 4.408 0 0 0 1.226-1.204c.749-1.1.749-2.633.749-5.697c0-3.065 0-4.597-.749-5.697a4.407 4.407 0 0 0-1.226-1.204c-.72-.473-1.622-.642-3.003-.702c-.659 0-1.226-.49-1.355-1.125A2.064 2.064 0 0 0 13.634 3h-3.268c-.988 0-1.839.685-2.033 1.636c-.129.635-.696 1.125-1.355 1.125c-1.38.06-2.282.23-3.003.702A4.405 4.405 0 0 0 2.75 7.667C2 8.767 2 10.299 2 13.364c0 3.064 0 4.596.749 5.697c.324.476.74.885 1.226 1.204C5.096 21 6.657 21 9.778 21Z" />
                                                <path stroke-linecap="round" d="M19 10h-1" />
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive text-wrap">
                        <form action="{{ route('update-lokasi') }}" method="post" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Ke Ruang:</label>
                                <select class="form-control" name="ruangan_id">
                                    @foreach ($ruang as $index => $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->kd_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="table-responsive text-wrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">No</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Kategori Barang</th>
                                            <th scope="col">Sub Kategori Barang</th>
                                            <th scope="col">Kode Barang</th>
                                            <th scope="col">No Inventarisasi</th>
                                            <th scope="col">Kondisi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Di Input Oleh</th>
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
                                                    <td><input type="checkbox" name="id[]" value="{{ $lokasi->id }}"></td>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td>
                                                        <img src="{{ asset('foto-barang/' . $lokasi->detail_barang->barang->foto) }}"
                                                            alt="" style="width: 60px;">
                                                    </td>
                                                    <td>{{ $lokasi->detail_barang->detail_barang_masuk->nama_barang }}</td>
                                                    <td>{{ $lokasi->detail_barang->barang->kategori->kategori }}</td>
                                                    <td>{{ $lokasi->detail_barang->barang->sub_kategori->sub_kategori }}
                                                    </td>
                                                    <td>{{ $lokasi->detail_barang->kode_barang }}</td>
                                                    <td>{{ $lokasi->detail_barang->no_inventarisasi }}</td>
                                                    <td>{{ $lokasi->detail_barang->kondisi }}</td>
                                                    <td>{{ $lokasi->detail_barang->status }}</td>
                                                    {{-- <td>{{ $lokasi->departemen->departemen }}</td> --}}
                                                    <td>{{ $lokasi->user->name }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer ml-auto">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" onclick="cancelEdit()" class="btn btn-primary">Cancel</button>
                                
                        </form>
                    </div>
                </div>
                {{-- <div class="card-footer">
                    {{ $data->links() }}
                </div> --}}
            </div>
        </div>
    </div>


    @push('js')
        <script>
            function showEditForm() {
                // Menampilkan formulir pengeditan
                document.getElementById('detailBarang').style.display = 'none';
                document.getElementById('editForm').style.display = 'block';

                // Mengisi nilai input dengan detail barang yang ada
                var namaBarang = document.getElementById('namaBarang').innerText;
                var hargaBarang = document.getElementById('hargaBarang').innerText;
                document.getElementById('editNamaBarang').value = namaBarang;
                document.getElementById('editHargaBarang').value = hargaBarang;
            }

            function saveChanges() {
                // Mengambil nilai dari input yang telah diubah
                var editedNamaBarang = document.getElementById('editNamaBarang').value;
                var editedHargaBarang = document.getElementById('editHargaBarang').value;

                // Menyimpan nilai yang telah diubah ke detail barang
                document.getElementById('namaBarang').innerText = editedNamaBarang;
                document.getElementById('hargaBarang').innerText = editedHargaBarang;

                // Menampilkan kembali detail barang dan menyembunyikan formulir pengeditan
                document.getElementById('detailBarang').style.display = 'block';
                document.getElementById('editForm').style.display = 'none';
            }

            function cancelEdit() {
                // Menampilkan kembali detail barang dan menyembunyikan formulir pengeditan tanpa menyimpan perubahan
                document.getElementById('detailBarang').style.display = 'block';
                document.getElementById('editForm').style.display = 'none';
            }
        </script>
    @endpush
@endsection
