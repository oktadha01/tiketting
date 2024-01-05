<script>
$('#tambah-data, #ubah-price').on('shown.bs.modal', function() {
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
    // console.log('Event terpilih:', $(this).val());
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
    // console.log('Event terpilih:', $(this).val());
});

$(document).ready(function() {
    var table;

    table = $('#data-price').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Prices/get_dataprice')?>",
            "type": "POST",
        },

    })
});

function confirmDelete(id_price) {
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
            // Jika pengguna menekan tombol "Ya", maka lakukan aksi hapus data
            window.location.href = '<?php echo site_url('Prices/hapus/'); ?>' + id_price;
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

// check status tanggal akhir pre sale
function perbaruiStatus() {
    var checkboxStatus = document.getElementById('status');
    var nilaiStatus = checkboxStatus.checked ? 1 : 0;
    // console.log('Nilai Status:', nilaiStatus);

    var dueKategoriContainer = document.getElementById('due-kategori-container');

    if (nilaiStatus === 1) {
        dueKategoriContainer.style.display = 'block';
    } else {
        dueKategoriContainer.style.display = 'none';
    }
    return nilaiStatus;
}
// kode simpan data
$('#tambah-data').submit(function(event) {
    event.preventDefault();

    var id_event = $('#id-event').val();
    var kategori_price = $('#kategori-price').val();
    var harga = $('#harga').val();
    var jumlah_tiket = $('#jumlah-tiket').val();
    var stock_tiket = $('#stock-tiket').val();
    var status = perbaruiStatus() ? 1 : 0;
    var akhir_promo = $('#due-kategori').val();


    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('Prices/input_price') ?>',
        data: {
            id_event: id_event,
            kategori_price: kategori_price,
            harga: harga,
            jumlah_tiket: jumlah_tiket,
            stock_tiket: stock_tiket,
            status: status,
            akhir_promo: akhir_promo,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Price Berhasil Dibuat.',
                });

                location.reload();
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
// akhir kode simpan data

$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var id_price = $(this).data('id_price');
        var id_event = $(this).data('id_event');
        var kategori_price = $(this).data('kategori_price');
        var tiket = $(this).data('tiket');
        var jumlah_tiket = $(this).data('jumlah_tiket');
        var stock_tiket = $(this).data('stock_tiket');
        var akhir_promo = $(this).data('akhir_promo');
        var status = $(this).data('status');

        $('#ubah-price #id-price').val(id_price);
        $('#ubah-price #edit-id-event').val(id_event);
        $('#ubah-price #edit-kategori-price').val(kategori_price);
        $('#ubah-price #edit-harga').val(tiket);
        $('#ubah-price #edit-jumlah-tiket').val(jumlah_tiket);
        $('#ubah-price #edit-stock-tiket').val(stock_tiket);
        $('#ubah-price #edit-akhir').val(akhir_promo);
        $('#ubah-price #edit-status').prop('checked', status == 1);

        perbaruiStatusedit();
    });
});

// check status tanggal akhir pre sale untuk edit
function perbaruiStatusedit() {
    var checkboxStatus = document.getElementById('edit-status');
    var nilaiStatus = checkboxStatus.checked ? 1 : 0;
    // console.log('Nilai Status:', nilaiStatus);

    var dueKategoriContainer = document.getElementById('due-kategori-edit');

    if (nilaiStatus === 1) {
        dueKategoriContainer.style.display = 'block';
    } else {
        dueKategoriContainer.style.display = 'none';
    }
    return nilaiStatus;
}

$('#ubah-price').submit(function(e) {
    e.preventDefault();
    var form = $(this);

    if (form.data('requestRunning')) {
        return;
    }

    var formData = {
        id_price: $('#id-price').val(),
        id_event: $('#edit-id-event').val(),
        kategori_price: $('#edit-kategori-price').val(),
        harga: $('#edit-harga').val(),
        jumlah_tiket: $('#edit-jumlah-tiket').val(),
        stock_tiket: $('#edit-stock-tiket').val(),
        status: $('#edit-status').prop('checked') ? 1 : 0,
        akhir_promo: $('#edit-akhir').val(),
    };

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Prices/edit_price'); ?>",
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
                    text: 'Data Prices Berhasil Diubah.',
                });

                location.reload();
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