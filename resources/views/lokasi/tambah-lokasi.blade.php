@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-lokasi') }}" method="post" class="needs-validation" novalidate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="M">Ruangan</label>
                                    <select
                                        class="form-control select2
                                            @error('ruangan_id')
                                                is-invalid
                                            @enderror"
                                        name="ruangan_id">
                                        <option value="">Pilih Ruangan</option>
                                        @foreach ($ruangan as $index => $ruangan)
                                            <option value="{{ $ruangan->id }}">{{ $ruangan->kd_ruangan }}</option>
                                        @endforeach
                                    </select>
                                    @error('ruangan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="">Filter</label>
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value=" ">Pilih Barang</option>
                                        @foreach ($sub_kategori as $index => $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->sub_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="detail-barang-container">
                                    @foreach ($detail_barang as $det_brg)
                                        @php
                                            $isExist = \App\Models\Lokasi::where('detail_barang_id', $det_brg->id)->exists();
                                        @endphp
                                        @if (!$isExist)
                                            <div class="detail-barang" data-kategori="{{ $det_brg->barang->sub_kategori_id }}"
                                                style="display:none ;">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label for="check">
                                                                    <div class="container">
                                                                        <input class="" type="checkbox" id="check"
                                                                            name="detail_barang_id[]"
                                                                            value="{{ $det_brg->id }}">
                                                                        <img src="{{ asset('foto-barang/' . $det_brg->barang->foto) }}"
                                                                            alt="" style="width: 60px;">
                                                                        {{ $det_brg->detail_barang_masuk->nama_barang . ' ' .$det_brg->barang->kategori->kategori . ' ' . $det_brg->kode_barang }}
                                                                    </div>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                        @endif
                                    @endforeach
                                </div>
                                {{-- <div class="card-footer">
                                    {{ $detail_barang->links() }}
                                </div> --}}
                            </div>
                        </div>
                </div>
                <div class="d-flex flex-row ">
                    <div class="col-sm-12 col-md-6">
                        <a href="{{ route('lokasi') }}" class="btn btn-primary btn-block">Batal</a>
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
    @push('js')
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

                    if (selectedKategori === "" || kategori === selectedKategori) {
                        detailBarang.style.display = 'block';
                    } else {
                        detailBarang.style.display = 'none';
                    }
                }
            }
        </script>
    @endpush
@endsection
