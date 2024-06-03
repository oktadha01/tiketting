<script>
$(document).ready(function() {
    var table;

    table = $('#user-scan').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('User/get_userscan')?>",
            "type": "POST",
        },

        "columnDefs": [{
                "targets": [3, 4],
                "className": 'text-right'
            },
            {
                "targets": [0, 2],
                "className": 'text-left'
            },
            {
                "targets": [1],
                "className": 'text-center'
            },
            {
                "targets": [4],
                "orderable": false
            },
        ]
    })
});

function option_event() {
    $.ajax({
        url: '<?=site_url('User/get_event')?>',
        type: 'GET',
        success: function(data) {
            $('#options_event').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

option_event();

$('#options_event').on('change', function() {
    console.log('kategori terpilih:', $(this).val());
});

function option_event_edit() {
    $.ajax({
        url: '<?=site_url('User/get_event')?>',
        type: 'GET',
        success: function(data) {
            $('#options_event-edit').html(data);
        },
        error: function() {
            console.error('Error fetching data.');
        }
    });
}

option_event_edit();

$('#options_event-edit').on('change', function() {
    console.log('kategori terpilih:', $(this).val());
});

// show password
function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    var icon = document.querySelector('.toggle-password');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// kode simpan data
$('#tambah-data').submit(function(event) {
    event.preventDefault();

    $('#btn-text').hide();
    $('#loading-icon').show();
    $('#btn-simpan').attr('disabled', true);

    var agency = $('#agency').val();
    var id_event = $('#options_event').val();
    var email = $('#email').val();
    var nama = $('#nama').val();
    var password = $('#password').val();

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('User/tambah_userscan') ?>',
        data: {
            agency: agency,
            id_event: id_event,
            nama: nama,
            email: email,
            password: password,
        },
        dataType: 'json',
        success: function(response) {
            $('#btn-text').hide();
            $('#loading-icon').show();
            $('#btn-simpan').attr('disabled', true);

            if (response.status) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'User Berhasil Dibuat.',
                    timer: 1500,
                });

                var table = $('#user-scan').DataTable();
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

//kode ubah user scan
$(document).ready(function() {
    $(document).on('click', '.btn-editscan', function() {
        var id_user = $(this).data('id_user');
        var agency = $(this).data('agency');
        var nm_user = $(this).data('nama');
        var id_event = $(this).data('id_event');
        var email = $(this).data('email');
        var password = $(this).data('password');

        console.log(id_user, agency, nm_user, id_event, email, password);

        $('#ubah-userScan #id-user').val(id_user);
        $('#ubah-userScan #data-agency').val(agency);
        $('#ubah-userScan #data-nama').val(nm_user);
        $('#ubah-userScan #options_event-edit').val(id_event);
        $('#ubah-userScan #data-email').val(email);
        $('#ubah-userScan #scan-password').val('Langsung Isi Sandi Baru');
    });
});


$('#ubah-scan').submit(function(e) {
    e.preventDefault();
    $('#btn-ubah').attr('disabled', true);
    $('#btn-text-edit').hide();
    $('#loading-icon-edit').show();

    var form = $(this);

    if (form.data('requestRunning')) {
        return;
    }

    var formData = {
        id_user: $('#id-user').val(),
        agency: $('#data-agency').val(),
        nama: $('#data-nama').val(),
        id_event: $('#options_event-edit').val(),
        email: $('#data-email').val(),
        password: $('#scan-password').val(),
    };

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('User/edit_userScan'); ?>",
        data: formData,
        beforeSend: function() {
            form.data('requestRunning', true);
        },
        success: function(response) {
            $('#btn-ubah').attr('disabled', true);
            $('#btn-text-edit').hide();
            $('#loading-icon-edit').show();

            if (response.status) {
                console.log(response);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Survey Berhasil Diubah.',
                    timer: 1500,
                });

                var table = $('#user-scan').DataTable();
                table.ajax.reload(null, false);
                $('#ubah-userScan').modal('hide');
                $('#btn-ubah').text('Ubah');
                $('#btn-ubah').prop('disabled', false);

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
            $('#btn-ubah').attr('disabled', true);
            $('#btn-text-edit').hide();
            $('#loading-icon-edit').show();

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

function confirmDelete(id_user) {
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
                url: '<?php echo site_url('User/hapus/'); ?>' + id_user,
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        // Menampilkan notifikasi sukses tanpa reload
                        swalWithBootstrapButtons.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        // Menghapus baris tabel secara dinamis (asumsi Anda menggunakan tabel datatables)
                        var table = $('#user-scan').DataTable();
                        table.row('#row_' + id_user).remove().draw(false);

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
</script>