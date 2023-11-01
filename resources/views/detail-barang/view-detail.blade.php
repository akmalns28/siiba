@extends('layout.main')
@push('css')
@endpush
@section('container')
    <div class="container">
        <div id="detailBarang">
            <!-- Menampilkan detail barang -->

            <p>Nama Barang: <span id="namaBarang">Baju</span></p>
            <p>Harga Barang: <span id="hargaBarang">Rp 100.000</span></p>
            <button onclick="showEditForm()" class="btn btn-primary">Edit</button>
        </div>

        <div id="editForm" style="display: none;">
            <!-- Formulir pengeditan -->
            <input type="text" id="editNamaBarang" class="form-control" placeholder="Nama Barang"><br>
            <input type="text" id="editHargaBarang" class="form-control" placeholder="Harga Barang"><br>
            <button onclick="saveChanges()" class="btn btn-success">Simpan</button>
            <button onclick="cancelEdit()" class="btn btn-secondary">Batal</button>
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
