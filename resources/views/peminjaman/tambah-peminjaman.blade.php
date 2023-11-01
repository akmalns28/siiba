@extends('layout.main')
@push('css')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
@section('container')
    <div class="card">
        <div class="card-body">
            <div class="progress mb-3">
                <div class="progress-bar" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <form action="{{ route('insert-peminjaman') }}" method="post" class="needs-validation" novalidate
                enctype="multipart/form-data" class="wizard-content mt-2">
                @csrf
                {{-- step 1 --}}
                <div class="step" id="step1">
                    <div class="text-center my-4">
                        <h5>Data Diri Peminjam</h5>
                        <p>Untuk melakukan peminjaman barang, isi terlebih dahulu formulir yang tersedia</p>
                    </div>
                    <div class="wizard-pane">
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left M">Nama Lengkap</label>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap"
                                    value="{{ old('nama') }}" autofocus
                                    class="form-control  
                        @error('nama')
                            is-invalid
                        @enderror">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left M">No Hp</label>
                            <div class="col-lg-4 col-md-6">
                                <input type="number" name="no_hp" id="no_hp" onkeydown="preventNegativeInput(event)"
                                    placeholder="Masukan No Hp" value="{{ old('no_hp') }}"
                                    class="form-control 
                        @error('no_hp')
                            is-invalid
                        @enderror">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left M">Jabatan</label>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" name="jabatan" id="jabatan" placeholder="Masukan Jabatan "
                                    value="{{ old('jabatan') }}"
                                    class="form-control 
                        @error('jabatan')
                            is-invalid
                        @enderror">
                                @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Contoh: Guru,Siswa,Pembina futsal,dll
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6">
                                        <a href="{{ route('peminjaman') }}"
                                            class="btn btn-primary mt-3 btn-block">Batal</a>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <a href="#" class="btn btn-primary mt-3 btn-block" id="nextBtn1">Selanjutnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- step 2 --}}
                <div id="step2" class="step">
                    <div class="text-center my-4">
                        <h5>Pilih Barang</h5>
                        <p>Untuk melakukan peminjaman barang, isi terlebih dahulu formulir yang tersedia</p>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="">Pilih Barang</label>
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="">Pilih Barang</option>
                                @foreach ($sub_kategori as $index => $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->sub_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="detail-barang-container">
                            @foreach ($detail_barang as $det_brg)
                                @if ($det_brg->status == 'In Stock')
                                    <div class="detail-barang" data-kategori="{{ $det_brg->barang->sub_kategori_id }}"
                                        style="display:none;">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label for="check">
                                                            <div class="container">
                                                                <input class="" type="checkbox" id="check"
                                                                    name="detail_barang_id[]" value="{{ $det_brg->id }}">
                                                                <img src="{{ asset('foto-barang/' . $det_brg->barang->foto) }}"
                                                                    alt="" style="width: 60px;">
                                                                {{ $det_brg->detail_barang_masuk->nama_barang . ' ' . $det_brg->barang->kategori->kategori . ' ' . $det_brg->kode_barang }}
                                                            </div>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex flex-row ">
                        <div class="col-sm-12 col-md-6">
                            <a href="#" class="btn btn-primary mt-3 btn-block" id="prevBtn2">Sebelumnya</a>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <button type="submit" class="btn btn-primary mt-3 btn-block">Pinjam</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/multi-step-form.js') }}"></script>
        {{-- <script src="{{ asset('js/insert-data/peminjaman.js') }}"></script> --}}
        <script>
            // Validasi form saat mengisi input
            $("#nis, #nama, #no_hp, #jabatan").on("input", function() {
                validateForm();
            });

            // Fungsi untuk melakukan validasi form
            function validateForm() {
                var nis = $("#nis").val();
                var nama = $("#nama").val();
                var noHp = $("#no_hp").val();
                var jabatan = $("#jabatan").val();

                if (nis !== "" && nama !== "" && noHp !== "" && jabatan !== "") {
                    $("#nextBtn1").prop("disabled", false);
                } else {
                    $("#nextBtn1").prop("disabled", true);
                }
            }

            // Inisialisasi validasi form saat halaman dimuat
            validateForm();
        </script>
        <script>
            function preventNegativeInput(event) {
                if (event.key === "-" || event.key === "e" || event.key === "E") {
                    event.preventDefault();
                }
            }
        </script>
        <script>
            document.getElementById('kategori').addEventListener('change', function() {
                var selectedKategori = this.value;
                filterDetailBarang(selectedKategori);
            });

            // Fungsi untuk memfilter dan menampilkan data Detail Barang berdasarkan Kategori
            function filterDetailBarang(selectedKategori) {
                var detailBarangs = document.getElementsByClassName('detail-barang');

                for (var i = 0; i < detailBarangs.length; i++) {
                    var detailBarang = detailBarangs[i];
                    var kategori = detailBarang.getAttribute('data-kategori');
                    var isInStock = detailBarang.getAttribute('data-status') === 'In Stock';

                    if (selectedKategori === "" || (kategori === selectedKategori && isInStock)) {
                        detailBarang.style.display = 'none';
                    } else {
                        detailBarang.style.display = 'block';
                    }
                }
            }
        </script>
    @endpush
@endsection
