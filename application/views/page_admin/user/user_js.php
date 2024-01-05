<script>
$(document).ready(function() {
    var table;

    table = $('#data-user').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('User/get_datauser')?>",
            "type": "POST",
        },

        "columnDefs": [{
                "targets": [3, 4, 5],
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
                "targets": [4, 5, 6, 7],
                "orderable": false
            },
        ]
    })
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
            // Jika pengguna menekan tombol "Ya", maka lakukan aksi hapus data
            window.location.href = '<?php echo site_url('User/hapus/'); ?>' + id_user;
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

// kode simpan data
$('#tambah-data').submit(function(event) {
    event.preventDefault();

    var agency = $('#agency').val();
    var nama = $('#nama').val();
    var alamat = $('#alamat').val();
    var email = $('#email').val();
    var kontak = $('#kontak').val();
    var password = $('#password').val();
    var privilage = $('#privilage').val();

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('User/input_user') ?>',
        data: {
            agency: agency,
            nama: nama,
            alamat: alamat,
            email: email,
            kontak: kontak,
            password: password,
            privilage: privilage,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'User Berhasil Dibuat.',
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

$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var id_user = $(this).data('id_user');
        var agency = $(this).data('agency');
        var nm_user = $(this).data('nama');
        var alamat = $(this).data('alamat');
        var email = $(this).data('email');
        var kontak = $(this).data('kontak');
        var password = $(this).data('password');
        var privilage = $(this).data('privilage');

        $('#ubah-user #data-id').val(id_user);
        $('#ubah-user #data-agency').val(agency);
        $('#ubah-user #data-nama').val(nm_user);
        $('#ubah-user #data-alamat').val(alamat);
        $('#ubah-user #data-email').val(email);
        $('#ubah-user #data-kontak').val(kontak);
        $('#ubah-user #data-password').val('Kata sandi sudah diatur');
        $('#ubah-user #data-privilage').val(privilage);
    });
});

$('#ubah-user').submit(function(e) {
    e.preventDefault();
    var form = $(this);

    if (form.data('requestRunning')) {
        return;
    }

    var formData = {
        id: $('#data-id').val(),
        agency: $('#data-agency').val(),
        nama: $('#data-nama').val(),
        alamat: $('#data-alamat').val(),
        email: $('#data-email').val(),
        kontak: $('#data-kontak').val(),
        password: $('#data-password').val(),
        privilage: $('#data-privilage').val(),
    };

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('User/edit_data'); ?>",
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
                    text: 'Data Survey Berhasil Diubah.',
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