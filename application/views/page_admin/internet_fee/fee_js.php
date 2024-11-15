<script>
$(document).ready(function() {

    var limit = 8;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit) {
        var output = '';
        // for (var count = 0; count < limit; count++) {
        output += '<div class="post_data">';
        output +=
            '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output +=
            '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        // }
        $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start, search = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>Internet_fee/fetch",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                search: search
            },
            cache: false,
            success: function(data) {
                if (data.trim() === '') {
                    $('#load_data_message').html(
                        '<div class="alert alert-danger alert-dismissible shadow-lg p-3 mb-4" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button>' +
                        '<i class="fa fa-folder-open"></i> Data Tidak Ada Lagi...</div>'
                    );
                    action = 'active';
                } else {
                    $('#load_data').append(data);
                    $('#load_data_message').html("");
                    action = 'inactive';
                }
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        load_data(limit, start);
    }

    $('#search-event').on('input', function() {
        var search = $(this).val();
        $('#load_data').html('');
        start = 0;
        lazzy_loader(limit);
        load_data(limit, start, search);
    });


    // kode untuk memuat ulang

    var baseUrl = "<?php echo base_url(); ?>";
    var limit = 8;
    var start = 0;
    var total_pages = 0;
    var action = 'inactive';

    function reloadFeeData() {
        var search = $('#search-reels').val();

        $('#load_data').html('');

        $.ajax({
            url: baseUrl + "Internet_fee/fetch",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                search: search
            },
            cache: false,
            success: function(data) {
                if (data.trim() === '') {
                    $('#load_data_message').html(
                        '<div class="alert alert-danger alert-dismissible shadow-lg p-3 mb-4" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button>' +
                        '<i class="fa fa-folder-open"></i> Data Tidak Ada Lagi...</div>'
                    );
                    action = 'active';
                } else {
                    $('#load_data').append(data);
                    $('#load_data_message').html("");
                    action = 'inactive';
                }
            },
            error: function(xhr, status, error) {
                $('#load_data_message').html(
                    '<div class="alert alert-danger">Gagal memuat data. Silakan coba lagi.</div>'
                );
            }
        });
    }
    // akhir code reload data

    // Ketika modal setting fee dibuka
    $('#setting-fee').on('show.bs.modal', function(e) {
        var idEvent = $(e.relatedTarget).data('id');

        // console.log("ID Event: " + idEvent);

        $('#id-event').val(idEvent);
    });

    // kode untuk setting fee
    $('#setting-fee').on('hidden.bs.modal', function() {
        $('#internet-fee')[0].reset();
    });

    $('#kategori').on('change', function() {
        var kategori = $(this).val();

        if (kategori === 'Default') {
            $('#nominal').val(7000);
            $('#nominal').prop('readonly', true);
        } else {
            $('#nominal').val('');
            $('#nominal').prop('readonly', false);
        }
    });

    // kode simpan data
    $('#btn-simpan').click(function(event) {
        event.preventDefault(); // Cegah form submit default

        // Sembunyikan teks, tampilkan loading, dan disable tombol
        $('#btn-text').hide();
        $('#loading-icon').show();
        $('#btn-simpan').attr('disabled', true);

        var id_event = $('#id-event').val();
        var kategori = $('#kategori').val();
        var nominal = $('#nominal').val();

        // Validasi input
        if (id_event === '' || kategori === '' || nominal === '') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Harap isi semua field!',
            });
            $('#btn-text').show();
            $('#loading-icon').hide();
            $('#btn-simpan').attr('disabled', false);
            return;
        }

        // Kirim data via AJAX
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('Internet_fee/setting_fee') ?>',
            data: {
                id_event: id_event,
                kategori: kategori,
                nominal: nominal,
            },
            dataType: 'json',
            success: function(response) {
                $('#btn-text').show();
                $('#loading-icon').hide();
                $('#btn-simpan').attr('disabled', false);

                if (response.status === 'success') {
                    Swal.fire({
                        position: "top-center",
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 1400
                    });
                    reloadFeeData();
                    $('#setting-fee').modal('hide');
                    $('#internet-fee')[0].reset();
                } else {
                    console.error('Terjadi kesalahan saat validasi data di server.');

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#btn-text').show();
                $('#loading-icon').hide();
                $('#btn-simpan').attr('disabled', false);

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

    // kode ubah internet fee
    $(document).on('click', '.btn-edit', function() {
        var id_fee = $(this).data('id');
        var kategori = $(this).data('kategori');
        var nominal = $(this).data('nominal');

        $('#ubah-fee #id-fee').val(id_fee);
        $('#ubah-fee #edit-kategori').val(kategori);
        $('#ubah-fee #edit-nominal').val(nominal);
    });

    $('#edit-kategori').on('change', function() {
        var kategori = $(this).val();

        if (kategori === 'Default') {
            $('#edit-nominal').val(7000);
            $('#edit-nominal').prop('readonly', true);
        } else {
            $('#edit-nominal').val('');
            $('#edit-nominal').prop('readonly', false);
        }
    });


    // Pastikan event submit menangani form yang benar
    $('#ubah-fee-form').submit(function(e) {
        e.preventDefault();
        $('#btn-text-ubah').hide();
        $('#loading-icon-ubah').show();
        $('#btn-ubah').attr('disabled', true);

        var form = $(this);

        if (form.data('requestRunning')) {
            return;
        }

        var formData = {
            id_fee: $('#id-fee').val(),
            kategori: $('#edit-kategori').val(),
            nominal: $('#edit-nominal').val(),
        };

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Internet_fee/edit_fee'); ?>",
            data: formData,
            beforeSend: function() {
                form.data('requestRunning', true);
            },
            success: function(response) {
                if (response.status) {
                    $('#btn-text-ubah').show();
                    $('#loading-icon-ubah').hide();
                    $('#btn-ubah').attr('disabled', false);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Perform Berhasil Diubah.',
                        timer: 1500
                    });

                    reloadFeeData();
                    $('#ubah-fee').modal('hide');
                    $('#ubah-fee-form')[0].reset();

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

});
</script>