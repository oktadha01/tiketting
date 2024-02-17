<script src="<?= base_url('assets'); ?>/js/email_validasi.js"></script>

<script>
    $('.menu-user').addClass('is-active');
    const menuLinks = document.querySelectorAll(".menu-user");
    menuLinks.forEach((link) => {
        link.addEventListener("click", () => {
            menuLinks.forEach((link) => {
                link.classList.remove("is-active");
            });
            link.classList.add("is-active");
        });
    })
    populateKota();
    var delayInMilliseconds = 700; //1 second
    setTimeout(function() {
        $('.select-kota').val($('.select-kota').attr('data-value')).trigger('change');
    }, delayInMilliseconds);

    $('#btn-batal-edit-profil, #btn-simpan-profil').removeAttr('hidden', true).hide();
    $("#gender-" + $('#val-gender').val()).prop("checked", true);

    $('#btn-edit-profil').click(function() {
        $('#nama, #tgl-lahir , #gender, #nik,  #kontak').removeAttr('readonly', true);
        $('#gender-male, #gender-female, #kota').removeAttr('disabled', true);
        $('#btn-batal-edit-profil, #btn-simpan-profil').show(200);
        $('#btn-edit-profil').hide(200);
        $('.ubah-password, .ubah-email, .row-btn-logout').hide(200);
    });
    $('#btn-batal-edit-profil').click(function() {
        batalorfinis_edit();
    });
    $('#btn-simpan-profil').click(function() {
        let formData = new FormData();
        formData.append('nama', $('#nama').val());
        formData.append('tgl-lahir', $('#tgl-lahir').val());
        formData.append('gender', $('#val-gender').val());
        formData.append('nik', $('#nik').val());
        formData.append('kota', $('#kota').val());
        formData.append('kontak', $('#kontak').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Userprofil/update_profil'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                batalorfinis_edit();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    });
    $('.gender').click(function() {
        if ($(this).is(":checked")) {
            $('#val-gender').val($(this).val())
        }
    });

    $('#notif-pass').hide();
    $('#notif-email').hide();
    $('.btn-ubah-email').click(function() {
        $('.email-baru').val($(this).data('email'));
    });
    $('.col-pass').hide();
    $('#email').on('input', function(e) {
        // alert('aaa')
        if ($('.valid_info').text() == 'The entered address is valid') {
            $('.col-pass').show();
        } else {
            $('.col-pass').hide();
        }
    });
    $('#password').on('input', function(e) {
        if ($(this).val() == '') {
            $('#btn-simpan-email').removeAttr('data-dismiss', true)
        } else {
            $('#btn-simpan-email').attr('data-dismiss', 'modal')
        }
    });

    $('#btn-simpan-email').click(function() {
        if ($('#password').val() == '') {
            $('.col-pass').show();
            $('.valid_pass').text('Password tidak boleh kosong !!')
        } else {

            let formData = new FormData();
            formData.append('email', $('.email-baru').val());
            formData.append('password', $('#password').val());
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Userprofil/update_email'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data == 'Email berhasil diubah') {
                        notif_email_success();
                        $('.text-email').text($('.email-baru').val());
                        $('.col-pass').hide();
                        $('.valid_pass').text('');
                        $('#password').val('');
                        $('#btn-simpan-email').removeAttr('data-dismiss', true);
                    } else {
                        batalorfinis_edit();
                        notif_email_gagal(data);
                        $('#password').val('');
                        $('#btn-simpan-email').removeAttr('data-dismiss', true);
                    }
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }
    });


    function batalorfinis_edit() {
        $('#nama, #tgl-lahir, #gender, #nik, #kontak').attr('readonly', true);
        $('#gender-male, #gender-female, #kota').attr('disabled', true);
        $('#btn-batal-edit-profil, #btn-simpan-profil').hide(200);
        $('#btn-edit-profil').show(200);
        $('.ubah-password, .ubah-email, .row-btn-logout').show(200);
    }

    function notif_email_success() {
        $('#notif-pass').addClass('notif-success-email').text('Email Berhasil Di Ubah').show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-pass').hide(300);
        }, delayInMilliseconds);
    };

    function notif_email_gagal(data) {
        $('#notif-email').addClass('notif-gagal-email').text(data).show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-email').hide(300);
        }, delayInMilliseconds);
    }

    function notif_pass_success() {
        $('#notif-pass').addClass('notif-success-pass').text('Password Berhasil Di Ubah').show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-pass').hide(300);
        }, delayInMilliseconds);
    };

    function notif_pass_gagal(data) {
        $('#notif-pass').addClass('notif-gagal-pass').text(data).show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-pass').hide(300);
        }, delayInMilliseconds);
    }

    function populateKota() {
        $.ajax({
            url: '<?= base_url('Buynow/get_ajax_kab') ?>',
            type: 'GET',
            success: function(data) {
                $('.select-kota').html(data);

            },
            error: function() {
                console.error('Error fetching data.');
            }
        });
    }
    $(function() {

        $('.select-kota').select2({
            placeholder: "Pilih Kota/Kabupaten",
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });
    });
</script>