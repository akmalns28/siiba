@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-barang') }}" method="post" class="needs-validation" novalidate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <div class="p-2 m-2 ">
                                            <div class="text-center">
                                                <img id="image-preview" src="https://via.placeholder.com/400"
                                                    style="width:100px" class="rounded rounded-circle" alt="placeholder">
                                            </div>
                                        </div>
                                    </div>
                                    <label>Foto</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*"
                                        onchange="updatePreview(this, 'image-preview')">
                                </div>
                                <div class="form-group">
                                    <label class="M">Kategori Barang</label>
                                    <select
                                        class="form-control select2 
                                            @error('kategori_id')
                                                is-invalid
                                            @enderror"
                                        name="kategori_id" id="category">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $index => $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="M" for="sub-kategori">Sub Kategori</label>
                                    <select class="form-control select2" name="sub_kategori_id" id="subcategory">
                                        <option value="">Pilih Sub Kategori</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="M">Aset</label>
                                    <select
                                        class="form-control select2
                                            @error('aset')
                                                is-invalid
                                            @enderror"
                                        name="aset">
                                        <option value="">Pilih Aset... </option>
                                        <option value="Barang Tetap">Barang Tetap</option>
                                        <option value="Barang Habis Pakai">Barang Habis Pakai</option>
                                    </select>
                                    @error('aset')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="M">Satuan</label>
                                    <select
                                        class="form-control select2
                                            @error('satuan_id')
                                                is-invalid
                                            @enderror"
                                        name="satuan_id">
                                        <option value="">Pilih Satuan</option>
                                        @foreach ($satuan as $index => $sat)
                                            <option value="{{ $sat->id }}">{{ $sat->satuan }}</option>
                                        @endforeach
                                    </select>
                                    @error('satuan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('barang') }}" class="btn btn-primary btn-block">Batal</a>
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
            function updatePreview(input, target) {
                let file = input.files[0];
                let reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = function() {
                    let img = document.getElementById(target);
                    // can also use "this.result"
                    img.src = reader.result;
                }
            }
        </script>
        <script>
            // Mengisi dropdown subkategori saat kategori dipilih
            $('#category').change(function() {
                var category_id = $(this).val();
                if (category_id !== '') {
                    $.ajax({
                        url: '/subcategories/' + category_id,
                        type: 'GET',
                        success: function(response) {
                            var options = '<option value="">Select Subcategory</option>';
                            $.each(response, function(index, SubKategori) {
                                options += '<option value="' + SubKategori.id + '">' + SubKategori
                                    .sub_kategori + '</option>';
                            });
                            $('#subcategory').html(options);
                        }
                    });
                } else {
                    $('#subcategory').html('<option value="">Select Subcategory</option>');
                }
            });
        </script>
    @endpush
@endsection
