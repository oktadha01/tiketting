<script>
$(document).ready(function() {
    var table;

    table = $('#data-xendit').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Xendit/get_dataxendit')?>",
            "type": "POST",
        },

        "columnDefs": [{
                "targets": [0, 1, 2],
                "className": 'text-left'
            },
            {
                "targets": [3, 4, 5],
                "className": 'text-center'
            },
            {
                "targets": [5],
                "orderable": false
            },
        ]
    })
});

function confirmDelete(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-3'
        },
        buttonsStyling: false
    })

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

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('Xendit/hapus/'); ?>' + id,
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        swalWithBootstrapButtons.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        // Menghapus baris tabel secara dinamis (asumsi Anda menggunakan tabel datatables)
                        var table = $('#data-xendit').DataTable();
                        table.row('#row_' + id).remove().draw(false);
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
            // Jika pengguna menekan tombol "Batal", tampilkan pesan batal menggunakan SweetAlert2
            Swal.fire(
                'Dibatalkan',
                'Data Anda tetap aman :)',
                'error'
            )
        }
    });
}



$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var value = $(this).data('value');
        var akun = $(this).data('akun');
        var status = $(this).data('status');

        $('#setting #id').val(id);
        $('#setting #name').val(name);
        $('#setting #value').val(value);
        $('#setting #akun').val(akun);
        $('#setting #status').val(status);
    });
});

$('#setting').submit(function(e) {
    e.preventDefault();
    var form = $(this);

    if (form.data('requestRunning')) {
        return;
    }

    var formData = {
        id: $('#id').val(),
        name: $('#name').val(),
        value: $('#value').val(),
        akun: $('#akun').val(),
        status: $('#status').val(),
    };

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Xendit/edit_data'); ?>",
        data: formData,
        beforeSend: function() {
            form.data('requestRunning', true);
        },
        success: function(response) {
            if (response.status) {
                console.log(response);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Xendit Berhasil Diubah.',
                    timer: 1500
                });

                var table = $('#data-xendit').DataTable();
                table.ajax.reload(null, false);
                $('#setting').modal('hide');

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
        complete: function() {
            form.data('requestRunning', false);
        },
    });
});
</script>