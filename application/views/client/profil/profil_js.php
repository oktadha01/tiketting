<script>
    $('#btn-batal-edit-profil, #btn-simpan-profil').removeAttr('hidden', true).hide();
    $("#gender-" + $('#val-gender').val()).prop("checked", true);

    $('#btn-edit-profil').click(function() {
        $('#email, #nama, #tgl-lahir , #gender, #nik, #kota, #kontak').removeAttr('readonly', true);
        $('#gender-male, #gender-female').removeAttr('disabled', true);
        $('#btn-batal-edit-profil, #btn-simpan-profil').show(200);
        $('#btn-edit-profil').hide(200);
        $('.ubah-password, .ubah-email').hide(200);
    });
    $('#btn-batal-edit-profil').click(function() {
        $('#email, #nama, #tgl-lahir , #gender, #nik, #kota, #kontak').attr('readonly', true);
        $('#gender-male, #gender-female').attr('disabled', true);
        $('#btn-batal-edit-profil, #btn-simpan-profil').hide(200);
        $('#btn-edit-profil').show(200);
        $('.ubah-password, .ubah-email').show(200);
    });

    $('.gender').click(function() {
        if ($(this).is(":checked")) {
            $('#val-gender').val($(this).val())
        }
    });


    $('#notif-pass').hide();
    $('#notif-email').hide();
    $('#btn-simpan-pass').click(function() {
        notif_pass_gagal();
    });
    $('#btn-simpan-email').click(function() {
        notif_email_gagal();
    });

    function notif_email_success() {
        $('#notif-pass').addClass('notif-success-email').text('Email Berhasil Di Ubah').show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-pass').hide(300);
        }, delayInMilliseconds);
    };

    function notif_email_gagal() {
        $('#notif-email').addClass('notif-gagal-email').text('Email Gagal Di Ubah').show(300);
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

    function notif_pass_gagal() {
        $('#notif-pass').addClass('notif-gagal-pass').text('Password Gagal Di Ubah').show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-pass').hide(300);
        }, delayInMilliseconds);
    }
</script>