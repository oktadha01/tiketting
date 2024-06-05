<script>
function checkInput() {
    var buyInput = document.getElementById('buy-input');
    var freeInput = document.getElementById('free-input');
    var buyWrapper = document.getElementById('buy');
    var freeWrapper = document.getElementById('free');

    if (buyInput.value > 5) {
        buyInput.value = 5;
    } else if (freeInput.value > 3) {
        freeInput.value = 3;
    }

}

$('#tambah-data, #ubah-price').on('shown.bs.modal', function() {
    $(function() {
        $('.select2').each(function() {
            $(this).select2({
                // theme: 'bootstrap3',
            });
        });
    });
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
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Prices/get_dataprice/')?><?= $this->uri->segment(3);?>",
            "type": "POST",
            "beforeSend": function() {
                $('#loading-spinner').removeClass('d-none');
            },
            "complete": function() {
                $('#loading-spinner').addClass('d-none');
            },
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

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('Prices/hapus/'); ?>' + id_price,
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

                        var table = $('#data-price').DataTable();
                        table.row('#row_' + id_price).remove().draw(false);
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


// check status tanggal akhir pre sale
function perbaruiStatus() {
    var checkboxStatus = document.getElementById('status');
    var nilaiStatus = checkboxStatus.checked ? 1 : 0;
    // console.log('Nilai Status:', nilaiStatus);

    var dueKategoriContainer = document.getElementById('due-kategori-container');
    var promoKelipatan = document.getElementById('promo-kelipatan');

    if (nilaiStatus === 1) {
        dueKategoriContainer.style.display = 'block';
        promoKelipatan.style.display = 'block';
        setTimeout(() => {
            dueKategoriContainer.classList.add("fade-in");
        }, 50);
    } else {
        dueKategoriContainer.style.display = 'none';
        promoKelipatan.style.display = 'none';
        // promoKelContainer.classList.remove("fade-in");

    }
    return nilaiStatus;
}

// check promo kelipatan
function togglePromoFields() {
    var promoKelCheckbox = document.getElementById("promo-kel");
    var buyInput = document.getElementById("buy");
    var freeInput = document.getElementById("free");
    var warningSpn = document.getElementById("warning");

    if (promoKelCheckbox.checked) {
        buyInput.style.display = "block";
        freeInput.style.display = "block";
        warningSpn.style.display = "block";
    } else {
        buyInput.style.display = "none";
        freeInput.style.display = "none";
        warningSpn.style.display = "none";
    }
}

// kode simpan data
$('#tambah-data').on('hidden.bs.modal', function() {
    $('#"kategori-price').val('');
    $('#harga').val('');
    $('#stock-tiket').val('');
    $('#status').val('');
    $('#promo-kel').val('');
    $('#akhir_promo').val('');
    $('#buy-input').val('');
    $('#free-input').val('');

});

$('#tambah-data').submit(function(event) {
    event.preventDefault();

    $('#btn-text').hide();
    $('#loading-icon').show();
    $('#btn-simpan').attr('disabled', true);

    var id_event = $('#id-event').val();
    var kategori_price = $('#kategori-price').val();
    var harga = $('#harga').val();
    var jumlah_tiket = $('#jumlah-tiket').val();
    var stock_tiket = $('#stock-tiket').val();
    var status = perbaruiStatus() ? 1 : 0;
    var akhir_promo = $('#akhir-promo').val();
    var buy = $('#buy-input').val();
    var free = $('#free-input').val();

    // var buy = $('#promo-kel').prop('checked')) ? $('#buy-input').val();
    var buy = ($('#promo-kel').prop('checked')) ? $('#buy-input').val() : 1;


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
            buy: buy,
            free: free,
        },
        dataType: 'json',
        success: function(response) {
            $('#btn-text').show();
            $('#loading-icon').hide();
            $('#btn-simpan').attr('disabled', false);

            if (response.status) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Price Berhasil Dibuat.',
                });

                var table = $('#data-price').DataTable();
                table.ajax.reload(null, false);
                $('#tambah-data').modal('hide');

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

$(document).ready(function() {
    $('#ubah-harga').on('shown.bs.modal', function() {
        perbaruiStatusedit();
        perbaruipromokel();
    });

    $('#edit-status').change(function() {
        perbaruiStatusedit();
    });
    $('#edit-promo-kel').change(function() {
        perbaruipromokel();
    });

    $(document).on('click', '.btn-edit', function() {
        var id_price = $(this).data('id_price');
        var id_event = $(this).data('id_event');
        var kategori_price = $(this).data('kategori_price');
        var tiket = $(this).data('tiket');
        var jumlah_tiket = $(this).data('jumlah_tiket');
        var stock_tiket = $(this).data('stock_tiket');
        var akhir_promo = $(this).data('akhir_promo');
        var status = $(this).data('status');
        var buy = $(this).data('beli');
        var free = $(this).data('gratis');

        $('#ubah-price #id-price').val(id_price);
        $('#ubah-price #edit-id-event').val(id_event);
        $('#ubah-price #edit-kategori-price').val(kategori_price);
        $('#ubah-price #edit-harga').val(tiket);
        $('#ubah-price #edit-jumlah-tiket').val(jumlah_tiket);
        $('#ubah-price #edit-stock-tiket').val(stock_tiket);
        $('#ubah-price #edit-akhir').val(akhir_promo);
        $('#ubah-price #edit-status').prop('checked', status == 1);
        $('#ubah-price #edit-promo-kel').prop('checked', buy > 1);
        $('#ubah-price #buy-input-edit').val(buy);
        $('#ubah-price #free-input-edit').val(free);

        perbaruipromokel();

    });
});

// check status tanggal akhir pre sale untuk edit
function perbaruiStatusedit() {
    var checkboxStatus = document.getElementById('edit-status');
    var checkboxkelipatan = document.getElementById('edit-promo-kel');

    var nilaiStatus = checkboxStatus.checked ? 1 : 0;
    // console.log('Nilai Status:', nilaiStatus);

    var dueKategoriContainer = document.getElementById('due-kategori-container-edit');
    var promo_kelipatan = document.getElementById('edit-promo-kelipatan');

    if (nilaiStatus === 1) {
        dueKategoriContainer.style.display = 'block';
        promo_kelipatan.style.display = 'block';
    } else {
        dueKategoriContainer.style.display = 'none';
        promo_kelipatan.style.display = 'none';
    }
    return nilaiStatus;
}

function perbaruipromokel() {
    var checkboxkelipatan = document.getElementById('edit-promo-kel');
    var buy = document.getElementById('buy-input-edit').value;

    var nilaikelipatan;
    if (checkboxkelipatan.checked) {
        if (buy == 2) {
            nilaikelipatan = 2;
        } else if (buy == 3) {
            nilaikelipatan = 3;
        } else if (buy == 4) {
            nilaikelipatan = 4;
        } else {
            nilaikelipatan = 0;
        }
    } else {
        nilaikelipatan = 0;
    }

    // console.log('Nilai promo:', nilaikelipatan);

    var buy_edit = document.getElementById('buy-edit');
    var free_edit = document.getElementById('free-edit');
    var warning_edit = document.getElementById('warning-edit');

    if (nilaikelipatan > 1) {
        buy_edit.style.display = 'block';
        free_edit.style.display = 'block';
        warning_edit.style.display = 'block';
    } else {
        buy_edit.style.display = 'none';
        free_edit.style.display = 'none';
        warning_edit.style.display = 'none';
    }
    return nilaikelipatan;
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

                var table = $('#data-price').DataTable();
                table.ajax.reload(null, false);
                $('#ubah-harga').modal('hide');

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

// kode bandling
$('#bundling').on('show.bs.modal', function(e) {
    var idEventBundle = $(e.relatedTarget).data('id-event-bundle');
    sendDataToController(idEventBundle);
});


function sendDataToController(idEventBundle) {
    $.ajax({
        url: '<?= site_url('Prices/get_ajax_tiket')?>',
        type: 'POST',
        data: {
            id_event_bundle: idEventBundle
        },
        success: function(response) {
            tiketSelectOptions(response);
        },
        error: function() {
            console.error('Error sending data to controller.');
        }
    });
}

function tiketSelectOptions(data) {
    var selectOptions = '<option value="">-- Pilih Tiket --</option>';
    data.forEach(function(option) {
        selectOptions += '<option value="' + option.id_price + '" data-stok="' + option.stock_tiket +
            '" data-id-price-bundle="' + option.id_price + '">' +
            option.kategori_price + '</option>';
    });

    $('#id-bundling').html(selectOptions);
    // $('#id-bundlingedit').html(selectOptions);
}


$('#id-bundling').on('change', function() {
    var selectedOption = $(this).find('option:selected');
    var stokValue = selectedOption.data('stok');
    var id_priceValue = selectedOption.attr('data-id-price-bundle');

    $('#stok').val(stokValue);
    $('#id-price-bundle').val(id_priceValue);

    console.log('Event terpilih:', selectedOption.val());
});

// perhitungan pembuatan bundling
document.addEventListener('DOMContentLoaded', function() {
    // Mendapatkan elemen input
    var isiBundleInput = document.getElementById('isi-bundle');
    var jmlBundleInput = document.getElementById('jml-bundle');
    var stockBundleInput = document.getElementById('stock-bundle');
    var jumlahTiketInput = document.getElementById('stok-tiket-reguler');
    var stokInput = document.getElementById('stok');
    var tombolSimpan = document.querySelector('#bundling button[type="submit"]');

    // Menambahkan event listener untuk perubahan nilai pada isi-bundle atau jml-bundle
    isiBundleInput.addEventListener('input', updateJumlahTiket);
    jmlBundleInput.addEventListener('input', updateJumlahTiket);
    stokInput.addEventListener('input', updateJumlahTiket);

    stokInput.addEventListener('change', function() {
        updateJumlahTiket();
    });

    // Fungsi untuk mengupdate nilai jumlah-tiket
    function updateJumlahTiket() {
        var isiBundle = parseInt(isiBundleInput.value) || 0;
        var jmlBundle = parseInt(jmlBundleInput.value) || 0;
        var stockBundle = isiBundle * jmlBundle;
        var stok = parseInt(stokInput.value) || 0;

        // Update nilai stock-bundle
        stockBundleInput.value = stockBundle;

        // Menghitung sisa tiket
        var sisaTiket = stok - stockBundle;
        jumlahTiketInput.value = sisaTiket;

        tombolSimpan.disabled = sisaTiket < 0;
    }

    updateJumlahTiket();
});

// kode simpan bundleng

$('#bundling').on('hidden.bs.modal', function() {
    $('#id-price-bundle').val('');
    $('#nm-bundling').val('');
    $('#harga-bundling').val('');
    $('#stock-bundle').val('');
    $('#stok-tiket-reguler').val('');
    $('#isi-bundle').val('');
    $('#jml-bundle').val('');
    $('#id-bundling').val('');
    $('#stock').val('');

});

$('#buat-bundling').submit(function(event) {
    event.preventDefault();

    var id_event = $('#id-event-bundle').val();
    var id_price = $('#id-price-bundle').val();
    var kategori_price = $('#nm-bundling').val();
    var harga = $('#harga-bundling').val();
    var isi_bundle = $('#isi-bundle').val();
    var stock_tiket = $('#stock-bundle').val();
    var tiket_reg = $('#stok-tiket-reguler').val();


    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('Prices/create_bundling') ?>',
        data: {
            id_event: id_event,
            id_price: id_price,
            kategori_price: kategori_price,
            harga: harga,
            isi_bundle: isi_bundle,
            stock_tiket: stock_tiket,
            tiket_reg: tiket_reg,

        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Price Berhasil Dibuat.',
                });

                var table = $('#data-price').DataTable();
                table.ajax.reload(null, false);
                $('#bundling').modal('hide');

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
// akhir kode bandling

// kode ubah bundling
$(document).ready(function() {
    $(document).on('click', '.btn-edit-bundling', function() {
        var id_price = $(this).data('id_price');
        // var id_event = $(this).data('id_event');
        var kategori_price = $(this).data('kategori_price');
        var harga_bundling = $(this).data('tiket');
        var stock_bundling = $(this).data('stock_tiket');
        var isi_bundling = $(this).data('tiket_bundle');

        $('#edit-bundling #edit-id-price-bundle').val(id_price);
        // $('#edit-bundling #id-event-bundle').val(id_event);
        $('#edit-bundling #edit-nm-bundling').val(kategori_price);
        $('#edit-bundling #edit-harga-bundling').val(harga_bundling);
        $('#edit-bundling #edit-isi-bundle').val(isi_bundling);
        $('#edit-bundling #edit-stock-bundle').val(stock_bundling);

    });
});

$(document).ready(function() {
    $('#ubah-bundling').on('shown.bs.modal', function() {
        hitungJumlahBundle();
    });
});

function hitungJumlahBundle() {
    var isiBundle = parseFloat(document.getElementById("edit-isi-bundle").value);
    var stockBundle = parseFloat(document.getElementById("edit-stock-bundle").value);
    var jmlBundleInput = document.getElementById("edit-jml-bundle");
    var warningElement = document.getElementById("edit-warning");
    var ubahButton = document.getElementById("ubah-button");

    if (!isNaN(isiBundle) && !isNaN(stockBundle)) {
        var jumlahBundle = stockBundle / isiBundle;
        jmlBundleInput.value = isNaN(jumlahBundle) ? "" : jumlahBundle.toFixed(1);

        var isBilanganBulat = jumlahBundle % 1 === 0 && jumlahBundle >= 0;

        ubahButton.disabled = !isBilanganBulat;

        if (isBilanganBulat) {
            warningElement.classList.add('fade-out');

            setTimeout(function() {
                warningElement.hidden = true;
                warningElement.classList.remove('fade-out');
                warningElement.classList.add('fade-in');
            }, 500);
        } else {
            warningElement.classList.add('fade-in');
            warningElement.hidden = false;

            setTimeout(function() {
                warningElement.classList.remove('fade-in');
            }, 500);
        }
    } else {
        jmlBundleInput.value = "";
        ubahButton.disabled = true;
        warningElement.hidden = true;
    }
}

$('#edit-bundling').submit(function(e) {
    e.preventDefault();
    var form = $(this);

    if (form.data('requestRunning')) {
        return;
    }

    var formData = {
        id_price: $('#edit-id-price-bundle').val(),
        // id_event: $('#id-event-bundle').val(),
        kategori_price: $('#edit-nm-bundling').val(),
        harga: $('#edit-harga-bundling').val(),
        stock_tiket: $('#edit-stock-bundle').val(),
        tiket_bundling: $('#edit-isi-bundle').val(),
    };

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Prices/edit_bundling'); ?>",
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
                    text: 'Data Bundling Berhasil Diubah.',
                });

                var table = $('#data-price').DataTable();
                table.ajax.reload(null, false);
                $('#ubah-bundling').modal('hide');

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

// akhir kode ubah bundling

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
            url: "<?php echo base_url(); ?>Prices/fetch",
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
                        '<i class="fa fa-folder-open"></i> Data Event Tidak Ada Lagi...</div>'
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

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action ==
            'inactive') {
            lazzy_loader(limit);
            action = 'active';
            start = start + limit;
            setTimeout(function() {
                load_data(limit, start);
            }, 1000);
        }
    });

});
</script>