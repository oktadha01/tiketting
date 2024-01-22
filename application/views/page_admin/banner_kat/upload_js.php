<script>
$(document).ready(function() {
    var table;

    table = $('#data-banner').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Banner_upload/get_banner')?>",
            "type": "POST",
        },

        "columnDefs": [{
                "targets": [0],
                "className": 'text-left'
            },
            {
                "targets": [1, 2],
                "className": 'text-center'
            },
        ]
    })
});

// kode simpan data
$('#tambah-data').on('hidden.bs.modal', function() {
    $('#banner-baru')[0].reset();

    $('.dropify-clear').trigger('click');
    $('.dropify-preview .dropify-render img').attr('src', '');
});

$('#tambah-data').submit(function(event) {
    event.preventDefault();

    var formData = new FormData($('#banner-baru')[0]);

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('Banner_upload/upload_banner') ?>',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Banner berhasil ditambahkan.',
                });

                var table = $('#data-banner').DataTable();
                table.ajax.reload(null, false);
                $('#tambah-data').modal('hide');
                $('#banner-baru')[0].reset();

                $('.dropify-clear').trigger('click');
                $('.dropify-preview .dropify-render img').attr('src', '');

            } else {
                console.error('Terjadi kesalahan saat validasi data di server.');
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat validasi data di server.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mengirim data ke server.',
            });
        }
    });
});
// akhir kode simpan dat

function confirmDelete(id_banner) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-3'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Menggunakan AJAX untuk menghapus data
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('Banner_upload/delete_banner/'); ?>' + id_banner,
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        // Menampilkan notifikasi sukses tanpa reload
                        swalWithBootstrapButtons.fire(
                            'Berhasil!',
                            'Data berhasil dihapus.',
                            'success'
                        );

                        // Menghapus baris tabel secara dinamis (asumsi Anda menggunakan tabel datatables)
                        var table = $('#data-banner').DataTable();
                        table.row('#row_' + id_banner).remove().draw(false);
                    } else {
                        // Menampilkan notifikasi gagal tanpa reload
                        swalWithBootstrapButtons.fire(
                            'Gagal!',
                            response.message || 'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    swalWithBootstrapButtons.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat mengirim permintaan ke server.',
                        'error'
                    );
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                'Dibatalkan',
                'Data Anda tetap aman :)',
                'error'
            );
        }
    });
}

$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var id_banner = $(this).data('id_banner');
        var header = $(this).data('header');
        var defaultHeaderValue = 'upload/banner/' + header;

        $('#edit-banner #edit-id-banner').val(id_banner);
        $('#edit-banner #header-lama').val(header);

        // Set nilai file default untuk dropify untuk header
        $('#edit-header').attr('data-default-file', defaultHeaderValue);
        $('#edit-header').dropify();

    });

    $('#ubah-banner').on('hidden.bs.modal', function() {
        location.reload();
    });

});

$('#ubah-banner').on('hidden.bs.modal', function() {
    $('#edit-banner')[0].reset();
    $('.dropify-clear').trigger('click');
    $('.dropify-preview .dropify-render img').attr('src', '');
});

$('#ubah-banner').on('show.bs.modal', function() {
    // Mengosongkan preview gambar saat modal ditampilkan
    $('.dropify-preview .dropify-render img').attr('src', '');
});

$('#edit-banner').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Banner_upload/edit_data'); ?>",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status) {
                console.log(response);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Event Berhasil Diubah.',
                });

                var table = $('#data-banner').DataTable();
                table.ajax.reload(null, false);
                $('#ubah-banner').modal('hide');
                $('#edit-banner')[0].reset();

                // // Mengatur sumber gambar sesuai respons baru
                // $('.dropify-preview .dropify-render img').attr('src', response.newImagePath);
                // $('.dropify-clear').trigger('click');

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message ||
                        'Terjadi kesalahan saat validasi data di server.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mengirim permintaan ke server.',
            });
        },
    });
});
</script>