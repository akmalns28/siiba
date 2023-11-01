document.getElementById("barang_id").value = "";
document.getElementById("departemen_id").value = "";
 // Array untuk menampung item barang masuk
let listItemBarangMasuk = [];

function addItem() {
    // Ambil nilai input
    let barangId = document.getElementById("barang_id").value;
    var selectElement = $('#barang_id');
    var selectedValue = selectElement.val();
    var namaBarang = selectElement.find('option[value="' + selectedValue + '"]').text();
    let pemilikId = document.getElementById("departemen_id").value;
    var selectElement = $('#departemen_id');
    var selectedValue = selectElement.val();
    var namaPemilik = selectElement.find('option[value="' + selectedValue + '"]').text();
    let namaProduk = document.getElementById("nama_barang").value;
    let harga = document.getElementById("harga").value;
    let jumlah = document.getElementById("jumlah").value;
    
    
 
    // Buat objek item barang masuk
    let itemBarangMasuk = {
        namaBarang: namaBarang,
        namaPemilik: namaPemilik,
        namaProduk: namaProduk,
        jumlah: jumlah,
        harga: harga,
        barangId : barangId,
        pemilikId : pemilikId,
    };

    // Tambahkan item barang masuk ke array
    if(namaBarang != '' ){
        listItemBarangMasuk.push(itemBarangMasuk);
    }

    // Reset nilai input
    document.getElementById("departemen_id").value = "";
    document.getElementById("barang_id").value = "";
    document.getElementById("nama_barang").value = "";
    document.getElementById("harga").value = "";
    document.getElementById("jumlah").value = "";

    // Tampilkan item barang masuk di daftar
    displayItemBarangMasuk();
    console.log(itemBarangMasuk);
 }

 function deleteItem(index) {
    listItemBarangMasuk.splice(index, 1);
    displayItemBarangMasuk();
 }

 function clearAllItems() {
    listItemBarangMasuk = [];
    displayItemBarangMasuk();
}

function formatRupiah(angka) {
    return "Rp " + angka.toLocaleString("id-ID");
}
 
 function displayItemBarangMasuk() {
    let tableBody = document.getElementById("tableBody");
    tableBody.innerHTML = "";
    let x = 1;
    let totalHarga = 0;

    // Loop melalui array item barang masuk dan tampilkan di tabel
    for (let i = 0; i < listItemBarangMasuk.length; i++) {
    let item = listItemBarangMasuk[i];

    let row = document.createElement("tr");
    let noCell = document.createElement("td");
    let namaPemilikCell = document.createElement("td");
    let namaBarangCell = document.createElement("td");
    let namaProdukCell = document.createElement("td");
    let jumlahCell = document.createElement("td");
    let hargaCell = document.createElement("td");
    let subHargaCell = document.createElement("td");
    let deleteCell = document.createElement("td");
    let deleteButton = document.createElement("button");

    noCell.textContent =x++;
    namaPemilikCell.textContent = item.namaPemilik;
    namaBarangCell.textContent = item.namaBarang;
    namaProdukCell.textContent = item.namaProduk;
    jumlahCell.textContent = item.jumlah;
    // Mengubah format harga menjadi "Rp"
    let hargaFormatted = formatRupiah(item.harga);
    hargaCell.textContent = hargaFormatted;
    let subHarga = item.jumlah * item.harga;
    subHargaCell.textContent = formatRupiah(subHarga);
    totalHarga += subHarga;
    deleteButton.innerHTML = '<i class="fas fa-times"></i>';
    deleteButton.classList.add("btn","btn-sm", "btn-danger");
    deleteButton.addEventListener("click", function() {
        deleteItem(i);
    });

    deleteCell.appendChild(deleteButton);

    row.appendChild(noCell);
    row.appendChild(namaPemilikCell);
    row.appendChild(namaBarangCell);
    row.appendChild(namaProdukCell);
    row.appendChild(jumlahCell);
    row.appendChild(hargaCell);
    row.appendChild(subHargaCell);
    row.appendChild(deleteCell);

    tableBody.appendChild(row);
    }

    // Tampilkan total harga 
    let totalHargaElement = document.getElementById("total-harga");
    totalHargaElement.textContent = "Total Harga: " + formatRupiah(totalHarga);


     // Event listener
    const btnTambahItem = document.getElementById('btn-tambah-detail');
    btnTambahItem.addEventListener('click', addItem);

    document.getElementById("btn-clear-all").addEventListener("click", clearAllItems); 
 }

 //  post ke db 
 $('#btn-tambah-barang-masuk').on('click',function(){
    let danaId = $('#dana_id').val();
    let supplierId = $('#supplier_id').val();
    let tgl_barang_masuk = $('#tgl_barang_masuk').val();
    let kode_barang_masuk = 'PAS01';
    let dataDetail = listItemBarangMasuk;
    let param = {
        danaId : danaId,
        supplierId : supplierId,
        tgl_barang_masuk : tgl_barang_masuk,
        kode_barang_masuk : kode_barang_masuk,
        dataDetail : dataDetail,
    }
    $.ajax({
        type: "POST",
        url: '/insert-barang-masuk',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
           data : param
        },
        dataType: 'json',
        success: function (data) {
            if(data.status){
                toastr.success('Data Telah Berhasil Ditambah');
                $('#tableBody').html('');
                document.getElementById("tgl_barang_masuk").value = "";
                document.getElementById("dana_id").value = "";
                document.getElementById("supplier_id").value = "";
            }else{
                toastr.error('Data Gagal Di Tambahkan')
            }
        },
        error: function (jqXHR, timeout, message) {
            toastr.error('Data Gagal Di Tambahkan')
            var contentType = jqXHR.getResponseHeader("Content-Type");
            if (jqXHR.status === 200 && contentType.toLowerCase().indexOf("text/html") >= 0) {
                // assume that our login has expired - reload our current page
                toastr.error('Data Gagal Di Tambahkan')
                //window.location.reload();
            }
        }
    });
    })