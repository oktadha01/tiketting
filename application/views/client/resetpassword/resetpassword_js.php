<script>
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var icon = document.querySelector(' .toggle-password');
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


        cek_token();
    });

    function cek_token() {
        let formData = new FormData();
        formData.append('token', '<?= $this->uri->segment(3); ?>');
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('ResetPassword/cek_token'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // alert(data)
                sweetalert(data);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }


    function btn_click_submit() {
        $('#btn-submit-c-pass').click(function() {
            let formData = new FormData();
            formData.append('token', '<?= $this->uri->segment(3); ?>');
            formData.append('password', $('#password'));
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('ResetPassword/set_password'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    // alert(data)
                    // var data = 'success';
                    sweetalert(data);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        });
    }

    function sweetalert(data) {
        var title_;
        var text_;
        var icon_;
        var url_action_oke;

        if (data == '1') {
            btn_click_submit(); // Assuming this function handles some action
        } else {
            if (data == '' | data == 'invalid') {
                title_ = 'Maaf !';
                text_ = 'Token tidak valid, silahkan coba lagi !';
                icon_ = 'error';
            } else if (data == 'success') {
                title_ = 'Proses Berhasil !';
                text_ = 'Kata sandi baru telah ditetapkan untuk akun Anda';
                icon_ = 'success';
            }

            Swal.fire({
                title: title_,
                text: text_,
                icon: icon_
            }).then((result) => {
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.cancel) {
                    // Redirect to the appropriate URL after user interaction
                    window.location.href = '<?= base_url('Auth'); ?>';
                }
            });
        }

    }
</script>