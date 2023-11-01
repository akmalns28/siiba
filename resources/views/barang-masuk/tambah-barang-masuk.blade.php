@extends('layout.main')
@push('css')
    <style>
        .close-icon {
            cursor: pointer;
        }
    </style>
@endpush
@section('container')
    <div class="card mb-3">
        <div class="col-12 align-items-center justify-content-beetwen py-3">
            <div class="d-flex flex-row justify-content-between">
                <a href="{{ route('barang-masuk') }}" class="btn btn-primary ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="M228 128a12 12 0 0 1-12 12H69l51.52 51.51a12 12 0 0 1-17 17l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z" />
                    </svg>Kembali
                </a>
                <div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- tambah barang  --}}
        <div class="col-sm-12 col-md-4">
            <form action="{{ route('tambah-barang-masuk') }}  method="post" class="needs-validation" novalidate>
                @csrf

                <form id="form-detail-barang-masuk">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0">Tambah Barang</h6>
                        </div>
                        <div class="card-body py-1">
                            <div class="form-group mb-2">
                                <label class="">Pemilik</label>
                                <select
                                    class="form-control 
                        @error('departemen_id')
                            is-invalid
                        @enderror"
                                    name="departemen_id" id="departemen_id">
                                    <option value="" disabled>Pilih Pemilik</option>
                                    @foreach ($departemen as $index => $brg)
                                        <option data-name="{{ $brg->departemen }}" value="{{ $brg->id }}">
                                            {{ $brg->departemen }}</option>
                                    @endforeach
                                </select>
                                @error('departemen_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="">Barang</label>
                                <select
                                    class="form-control 
                        @error('barang_id')
                            is-invalid
                        @enderror"
                                    name="barang_id" id="barang_id">
                                    <option value="" disabled>Pilih Barang</option>
                                    @foreach ($barang as $index => $brg)
                                        <option data-name="{{ $brg->kategori->kategori }}" value="{{ $brg->id }}">
                                            {{ $brg->kategori->kategori . ' ' . $brg->sub_kategori->sub_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" placeholder="Masukan Nama produk"
                                    value="{{ old('nama_barang') }}" autofocus
                                    class="form-control 
                            @error('nama_barang')
                                is-invalid
                            @enderror">
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row pb-2">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="inputEmail4">Harga</label>
                                    <input type="text" name="harga" onkeyup="" class="form-control" id="harga"
                                        placeholder="Masukan Harga">
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="inputPassword4">Jumlah</label>
                                    <input type="number" name="jumlah" min="1" class="form-control" id="jumlah"
                                        placeholder="Masukan Jumlah">
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-2">
                                <div class="col-sm-12 col-md-6">
                                    <a href="{{ route('barang-masuk') }}" class="btn btn-primary btn-block">Batal</a>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div type="" id="btn-tambah-detail" onclick="addItem()"
                                        class="btn btn-primary btn-block">Tambah</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

        </div>

        {{-- barang masuk  --}}
        <div class="col-sm-12 col-md-8">
            <form action="{{ route('tambah-barang-masuk') }}  method="post" class="needs-validation" novalidate>
                <div class="card">
                    <div class="card-header">
                        <h6>Barang Masuk</h6>
                    </div>
                    <div class="card-body py-1">
                        <div class="form-row">
                            <div class="form-group col-md-4 mb-2">
                                <label for="inputEmail4">Tangal Barang Masuk</label>
                                <input type="date" name="tgl_barang_masuk" class="form-control" id="tgl_barang_masuk"
                                    placeholder="Masukan Tanggal">
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label class="">Supplier</label>
                                <select
                                    class="form-control 
                            @error('supplier_id')
                                is-invalid
                            @enderror"
                                    name="supplier_id" id="supplier_id">
                                    <option value="">--Pilih Supplier--</option>
                                    @foreach ($supplier as $index => $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->nama_suplier }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label class="">Sumber Dana</label>
                                <select
                                    class="form-control 
                            @error('dana_id')
                                is-invalid
                            @enderror"
                                    name="dana_id" id="dana_id">
                                    <option value="">--Pilih Sumber Dana--</option>
                                    @foreach ($dana as $index => $sd)
                                        <option value="{{ $sd->id }}">{{ $sd->dana }}</option>
                                    @endforeach
                                </select>
                                @error('dana_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <table class="table table-responsive" id="daftar-detail-barang-masuk">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pemilik</th>
                                    <th>Kategori & Sub kategori</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <button type="button" class="btn btn-primary" id="btn-clear-all">Clear</button>
                                <button type="button" id="btn-tambah-barang-masuk"
                                    class="btn btn-primary btn-md">Simpan</button>
                            </div>
                            <div id="total-harga">
                                {{-- <h6 class="m-0">Total Harga : </h6> --}}
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        </form>
        </form>
    </div>


    @push('js')
        <script src="{{ asset('js/insert-data/barang-masuk.js') }}"></script>
    @endpush
@endsection
