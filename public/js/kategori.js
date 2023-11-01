// alert delete 
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
