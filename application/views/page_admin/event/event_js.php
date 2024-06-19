<script>
var successSound = new Audio('assets/suara/scanner-beep.mp3');


$('#tambah-data, #ubah-event').on('shown.bs.modal', function() {
    $(function() {
        $('.select2').each(function() {
            $(this).select2({
                // theme: 'bootstrap3',
            });
        });
    });
});

// untuk tambah data
function populateKota() {
    $.ajax({
        url: '<?=site_url('Event/get_ajax_kab')?>',
        type: 'GET',
        success: function(data) {
            $('#kota').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

populateKota();

$('#kota').on('change', function() {
    // console.log('Kota terpilih:', $(this).val());
});

// untuk edit data
function populateKotaedit() {
    $.ajax({
        url: '<?=site_url('Event/get_ajax_kab')?>',
        type: 'GET',
        success: function(data) {
            $('#edit-kota').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

populateKotaedit();

$('#edit-kota').on('change', function() {
    // console.log('Kota terpilih:', $(this).val());
});

// kategori event
function ketegori_event() {
    $.ajax({
        url: '<?=site_url('Event/get_kategori_event')?>',
        type: 'GET',
        success: function(data) {
            $('#kategori_event').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

ketegori_event();

$('#kategori_event').on('change', function() {
    // console.log('kategori terpilih:', $(this).val());
});

function edit_ketegori_event() {
    $.ajax({
        url: '<?=site_url('Event/get_kategori_event')?>',
        type: 'GET',
        success: function(data) {
            $('#edit-kategori-event').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

edit_ketegori_event();

$('#edit-kategori-event').on('change', function() {
    // console.log('kategori terpilih:', $(this).val());
});


$(document).ready(function() {
    var table;

    table = $('#data-event').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Event/get_dataevent')?>",
            "type": "POST",
        },

        "columnDefs": [{
                "targets": [3, 4, 5],
                "className": 'text-right'
            },
            {
                "targets": [0],
                "className": 'text-left'
            },
            {
                "targets": [1, 2],
                "className": 'text-center'
            },
            {
                "targets": [4, 5, 6, 7],
                "orderable": false
            },
        ]
    })
});

function confirmDelete(id_event) {
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
                url: '<?php echo site_url('Event/delete_event/'); ?>' + id_event,
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

                        var table = $('#data-event').DataTable();
                        table.row('#row_' + id_event).remove().draw(false);
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
            Swal.fire(
                'Dibatalkan',
                'Data Anda tetap aman :)',
                'error'
            )
        }
    });
}

// kode simpan data
$('#tambah-data').on('hidden.bs.modal', function() {
    $('#event-baru')[0].reset();

    $('.dropify-clear').trigger('click');
    $('.dropify-preview .dropify-render img').attr('src', '');
});

$('#tambah-data').submit(function(event) {
    event.preventDefault();

    $('#btn-text').hide();
    $('#loading-icon').show();
    $('#btn-simpan').attr('disabled', true);

    var formData = new FormData($('#event-baru')[0]);

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('Event/input_event') ?>',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            $('#btn-text').hide();
            $('#loading-icon').show();
            $('#btn-simpan').attr('disabled', true);

            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Event berhasil ditambahkan.',
                    timer: 1500
                });

                var table = $('#data-event').DataTable();
                table.ajax.reload(null, false);
                $('#tambah-data').modal('hide');
                $('#data-event')[0].reset();

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

// akhir kode simpan dat

$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var id_event = $(this).data('id_event');
        var id_user = $(this).data('id_user');
        var nm_event = $(this).data('nm_event');
        var tgl_event = $(this).data('tgl_event');
        var jam_event = $(this).data('jam_event');
        var batas_pesan = $(this).data('batas_pesan');
        var lokasi = $(this).data('lokasi');
        var kota = $(this).data('kota');
        var alamat = $(this).data('alamat');
        var kategori_event = $(this).data('nm_kategori_event');
        var desc_event = $(this).data('desc_event');
        var mc_by = $(this).data('mc_by');
        var poster = $(this).data('poster');
        var header = $(this).data('header');
        var defaultPosterValue = 'upload/event/' + poster;
        var defaultHeaderValue = 'upload/event/' + header;

        $('#ubah-event #edit-id-event').val(id_event);
        $('#ubah-event #edit-id-user').val(id_user);
        $('#ubah-event #edit-nm-event').val(nm_event);
        $('#ubah-event #edit-tgl-event').val(tgl_event);
        $('#ubah-event #edit-jam-event').val(jam_event);
        $('#ubah-event #edit-due-book').val(batas_pesan);
        $('#ubah-event #edit-lokasi').val(lokasi);
        $('#ubah-event #edit-kota').val(kota);
        $('#ubah-event #edit-alamat').val(alamat);
        $('#ubah-event #edit-kategori-event').val(kategori_event);
        $('#ubah-event #edit-deskripsi').val(desc_event);
        $('#ubah-event #edit-mc').val(mc_by);
        $('#ubah-event #poster-lama').val(poster);
        $('#ubah-event #header-lama').val(header);

        // Set nilai file default untuk dropify untuk poster
        $('#edit-poster').attr('data-default-file', defaultPosterValue);
        $('#edit-poster').dropify();

        // Set nilai file default untuk dropify untuk header
        $('#edit-header').attr('data-default-file', defaultHeaderValue);
        $('#edit-header').dropify();

    });

    $('#ubah-event').on('hidden.bs.modal', function() {
        location.reload();
    });

});

$('#edit-event').on('hidden.bs.modal', function() {
    $('#ubah-event')[0].reset();

    $('.dropify-clear').trigger('click');
    $('.dropify-preview .dropify-render img').attr('src', '');
});

$('#edit-event').submit(function(event) {
    event.preventDefault();

    $('#btn-text-ubah').hide();
    $('#loading-icon-ubah').show();
    $('#btn-ubah').attr('disabled', true);
    var formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Event/edit_data'); ?>",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            $('#btn-text').hide();
            $('#loading-icon').show();
            $('#btn-ubah').attr('disabled', true);

            if (response.status) {
                console.log(response);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Event Berhasil Diubah.',
                    timer: 1500
                });

                var table = $('#data-event').DataTable();
                table.ajax.reload(null, false);
                $('#ubah-event').modal('hide');
                $('#data-event')[0].reset();

                $('.dropify-preview .dropify-render img').attr('src', response.newImagePath);
                $('.dropify-clear').trigger('click');

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
            $('#btn-text').hide();
            $('#loading-icon').show();
            $('#btn-ubah').attr('disabled', true);

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