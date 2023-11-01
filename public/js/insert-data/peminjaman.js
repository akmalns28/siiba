
    // Mengumpulkan data peminjaman dan detail barang
    var peminjamanData = {};

    // Mengirim data peminjaman dan detail barang ke Laravel untuk disimpan
    $("#simpan-peminjaman").click(function() {
        var nis = $("#nis").val();
        var nama = $("#nama").val();
        var noHp = $("#no_hp").val();
        var jabatan = $("#jabatan").val();

        var detailBarang = [];

        // Mendapatkan data detail barang dari elemen select dengan class .barang
        $("#detail-barang").each(function() {
            var selectedOption = $(this).find("option:selected");
            var namaBarang = selectedOption.text();
            var idDetailBarang = selectedOption.data("id");

            // Menambahkan data detail barang ke dalam array
            if (idDetailBarang) {
                detailBarang.push({
                    idDetailBarang: idDetailBarang,
                    namaBarang: namaBarang
                });
            }
        });

        // Menyusun data peminjaman dan detail barang
        peminjamanData = {
            nis: nis,
            nama: nama,
            noHp: noHp,
            jabatan: jabatan,
            detailBarang: detailBarang
        };

        // Mengirim data ke Laravel menggunakan Ajax
        $.ajax({
            type: "POST",
            url: "/insert-peminjaman",
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                peminjamanData
            },
            success: function (data) {
                if(data.status){
                    toastr.success('Data Telah Berhasil Ditambah');
                    $('#tableBody').html('');
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
    });
