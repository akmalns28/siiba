// alert delete 
$('.dlt-satuan').click(function() {
    var idsatuan = $(this).attr('data-id');
    var satuan = $(this).attr('data-name');
    Swal.fire({
        title: 'Apakah Anda Yakin??',
        text: "Kamu akan menghapus data " + satuan + "",
        icon: 'warning',
        showCancelButton: true,
        buttons: true,
        dangerMode: true,
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "/delete-satuan/" + idsatuan + ""
            Swal.fire(
                'Deleted!',
                'Data ' + satuan + ' Telah Dihapus',
                'success'
            )
        }
    });
});
