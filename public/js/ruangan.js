// alert delete 
$('.dlt-ruangan').click(function() {
    var idruangan = $(this).attr('data-id');
    var ruangan = $(this).attr('data-name');
    Swal.fire({
        title: 'Apakah Anda Yakin??',
        text: "Kamu akan menghapus data " + ruangan + "",
        icon: 'warning',
        showCancelButton: true,
        buttons: true,
        dangerMode: true,
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "/delete-ruangan/" + idruangan + ""
            Swal.fire(
                'Deleted!',
                'Data ' + ruangan + ' Telah Dihapus',
                'success'
            )
        }
    });
});
