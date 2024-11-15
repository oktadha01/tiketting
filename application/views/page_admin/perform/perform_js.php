<script>
var successSound = new Audio('assets/suara/scanner-beep.mp3');

$('#tambah-data, #ubah-perform').on('shown.bs.modal', function() {
    $(function() {
        $('.select2').each(function() {
            $(this).select2({
                // theme: 'bootstrap3',
            });
        });
    });
});

function dataevent() {
    $.ajax({
        url: '<?=site_url('Perform/get_ajax_event')?>',
        type: 'GET',
        success: function(data) {
            $('#id-event').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

dataevent();

$('#id-event').on('change', function() {
    console.log('Event terpilih:', $(this).val());
});

// edit data
function dataeventedit() {
    $.ajax({
        url: '<?=site_url('Perform/get_ajax_event')?>',
        type: 'GET',
        success: function(data) {
            $('#edit-id-event').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

dataeventedit();

$('#edit-id-event').on('change', function() {
    console.log('Event terpilih:', $(this).val());
});

$(document).ready(function() {
    var table;

    table = $('#data-perform').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Perform/get_dataperform')?>",
            "type": "POST",
        },

    })
});

function confirmDelete(id_perform) {
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
                url: '<?php echo site_url('Perform/hapus/'); ?>' + id_perform,
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
                        var table = $('#data-perform').DataTable();
                        table.row('#row_' + id_perform).remove().draw(false);
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

$('#tambah-data').on('hidden.bs.modal', function() {
    $('#perform-baru')[0].reset();
});
// kode simpan data
$('#tambah-data').submit(function(event) {
    event.preventDefault();

    $('#btn-text').hide();
    $('#loading-icon').show();
    $('#btn-simpan').attr('disabled', true);

    var id_event = $('#id-event').val();
    var nama_artis = $('#nama-artis').val();
    var status_perform = $('#status-perform').val();

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('Perform/input_perform') ?>',
        data: {
            id_event: id_event,
            nama_artis: nama_artis,
            status_perform: status_perform,
        },
        dataType: 'json',
        success: function(response) {
            $('#btn-text').show();
            $('#loading-icon').hide();
            $('#btn-simpan').attr('disabled', false);

            if (response.status) {

                Swal.fire({
                    position: "top-center",
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Perform Berhasil Dibuat.',
                    timer: 1400
                });

                var table = $('#data-perform').DataTable();
                table.ajax.reload(null, false);
                $('#tambah-data').modal('hide');
                $('#tambah-data')[0].reset();

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
            $('#btn-text').hide();
            $('#loading-icon').show();
            $('#btn-simpan').attr('disabled', true);

            console.error(xhr.responseText);

            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mengirim data ke server.',
            });
        }
    });
});
// akhir kode simpan data

$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var id_perform = $(this).data('id_perform');
        var id_event = $(this).data('id_event');
        var nama_artis = $(this).data('nama_artis');
        var status_perform = $(this).data('status_perform');

        $('#ubah-perform #id-perform').val(id_perform);
        $('#ubah-perform #edit-id-event').val(id_event);
        $('#ubah-perform #edit-nama-artis').val(nama_artis);
        $('#ubah-perform #edit-status-perform').val(status_perform);

    });
});

$('#ubah-perform').submit(function(e) {
    e.preventDefault();
    $('#btn-text-ubah').hide();
    $('#loading-icon-ubah').show();
    $('#btn-ubah').attr('disabled', true);

    var form = $(this);

    if (form.data('requestRunning')) {
        return;
    }

    var formData = {
        id_perform: $('#id-perform').val(),
        id_event: $('#edit-id-event').val(),
        nama_artis: $('#edit-nama-artis').val(),
        status_perform: $('#edit-status-perform').val(),
    };

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Perform/edit_data'); ?>",
        data: formData,
        beforeSend: function() {
            form.data('requestRunning', true);
        },
        success: function(response) {
            if (response.status) {
                $('#btn-text-ubah').show();
                $('#loading-icon-ubah').hide();
                $('#btn-ubah').attr('disabled', false);
                // console.log(response);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Perform Berhasil Diubah.',
                    timer: 1500
                });

                var table = $('#data-perform').DataTable();
                table.ajax.reload(null, false);
                $('#ubah-perform').modal('hide');

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
            $('#btn-text-ubah').show();
            $('#loading-icon-ubah').hide();
            $('#btn-ubah').attr('disabled', false);
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