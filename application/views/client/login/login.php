<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/alert.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/style.css">
    <!-- Bootstrap Core Css -->
    <title>Sign in & Sign up Form</title>
    <!-- <link rel="icon" href="" type="image/gif" sizes="25x12"> -->
    <style>
        .form-control {

            border-radius: 18px;
            border: 2px solid #607D8B;

        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            margin-left: 15px;
        }

        .p-form {
            padding: 1px;
        }

        form {
            padding: 0rem 4rem;
        }

        @media only screen and (min-width: 200px) and (max-width: 1024px) and (orientation: portrait) {
            form {
                padding: 0 1.5rem;
            }

        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            form {
                padding: 0rem 2rem;
            }
        }

        .btn-lupa-pass {
            left: 108px;
            position: relative;
            color: blue;
            cursor: pointer;
        }

        .btn-danger {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .notif-email {
            right: 95px;
            position: relative;
            font-size: small;
            margin-bottom: 11px;
        }

        .invalid-email {
            border: 2px solid #ff00008c;
            color: red;
        }

        .valid-email {
            border: 2px solid #4CAF50;
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 100%;">
        <div class="forms-container">
            <div class="signin-signup">
                <form class="sign-in-form" action="<?= site_url('Auth/login_client') ?>" method="post" method="POST">

                    <!-- Alert -->
                    <?php
                    if (validation_errors() || $this->session->flashdata('result_login')) {
                    ?>
                        <div class="alert" id="autoCloseAlert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong style=" padding: 5px 5px 5px 5px;">Warning!</strong>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('result_login'); ?>
                        </div>

                    <?php } ?>

                    <?php
                    $data = $this->session->flashdata('sukses');
                    if ($data != "") {
                    ?>
                        <div class="alert alert-success"><strong>Sukses! </strong> <?= $data; ?></div>
                        <div class="alert alert-success" id="autoCloseAlert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </strong> <?= $data; ?>
                        </div>
                    <?php } ?>
                    <!-- Akhir Alert -->
                    <h2 class="title title-form">Sign in</h2>
                    <p class="social-text mb-0 text-center form-rest-pass" hidden>Masukkan alamat email Anda di bawah ini untuk mengatur ulang kata sandi Anda</p>
                    <div class="input-field form-login">
                        <i class="fa fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required autofocus autocomplete="current-email" />
                    </div>
                    <div class="input-field form-login">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="password" required autofocus autocomplete="current-password" />
                        <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility('password')"></i>
                    </div>
                    <div class="remember" hidden>
                        <input type="checkbox" id="remember" name="remember" value="" checked="true">
                        <label for="remember"> Remember</label>
                    </div>
                    <span class="btn-lupa-pass form-login">Lupa Password ?</span>
                    <input type="submit" value="Login" class="btn solid form-login " />

                    <!-- form reset password -->
                    <div class="input-field form-email-rest mb-0 form-rest-pass" hidden>
                        <i class="fa fa-envelope"></i>
                        <input type="email" class="email-rest" placeholder="Email" name="email" required autofocus autocomplete="current-email" />
                    </div>
                    <span class="notif-email form-rest-pass" hidden style="border: none;"></span>
                    <div class="row form-rest-pass" hidden>
                        <div class="col-6">
                            <button id="btn-batal" class="btn btn-danger">Batal</button>
                        </div>
                        <div class="col-6">
                            <button id="btn-submit" class="btn btn-primary" disabled>Submit</button>
                        </div>
                    </div>

                    <p class="social-text">Informasi Tentang System Bisa Lihat Sosial Media dibawah ini</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <form action="<?= site_url('Auth/regist_akun') ?>" method="POST" class="sign-up-form" style="align-items:normal">
                    <!-- <div class="card-body"> -->

                    <h2 class="title text-center mb-4">Registrasi Akun</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <!-- <label>Email</label> -->
                                <input type="text" name="email" placeholder="Email" required="" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <!-- <label>Nama</label> -->
                                <input type="text" name="nama" placeholder="Nama Lengkap" required="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <!-- <label>Tgl lahir</label> -->
                                <input type="text" name="tgl_lahir" placeholder="Tgl Lahir" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <!-- <label>gender</label> -->
                                <label class="fancy-radio">
                                    <input type="radio" id="gender-male-" class="gender gender-" data-no="" value="male">
                                    <span><i></i>Male</span>
                                </label>
                                <label class="fancy-radio">
                                    <input type="radio" id="gender-female-" class="gender gender-" data-no="" value="female">
                                    <span><i></i>Female</span>
                                </label>
                                <p id="error-radio"></p>
                                <input type="text" name="gender" id="gender-" value="" hidden>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <!-- <label>No Wa</label> -->
                                <input type="text" name="kontak" placeholder="No Wa" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <!-- <label>No identita</label> -->
                                <input type="text" name="no_identitas" placeholder="NIK" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <!-- <label>Kota / kabupaten</label> -->
                                <input type="text" name="kota" placeholder="Kota/Kabupaten" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <!-- <label>Password</label> -->
                                <input type="password" name="password" placeholder="Password" required="" class="form-control">
                            </div>
                        </div>
                        <div class="remember" hidden>
                            <input type="checkbox" id="remember" name="remember" value="" checked="true">
                            <label for="remember"> Remember</label>
                        </div>
                        <div class="col-12">
                            <input type="submit" value="Registrasi" class="btn solid" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Belum Punya Akun ?</h3>
                    <p>
                        Please klik Sign up untuk membuat akun baru !!!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="<?= base_url('assets/login/'); ?>img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3> Sudah Punya Akun</h3>
                    <p>
                        Silahkan Klik Sign in Untuk Masuk Ke System
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="<?= base_url('assets/login/'); ?>img/reg.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>assets/login/app.js"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.form-rest-pass').removeAttr('hidden', true).hide();
        $('.btn-lupa-pass').click(function() {
            $('.form-login').hide();
            $('.form-rest-pass').show(200);
            $('.title-form').text('Reset Password');
        });
        $('#sign-up-btn, #btn-batal').click(function() {
            $('.form-login').show(200);
            $('.form-rest-pass').hide();
            $('.title-form').text('Sign in');
            $('.email-rest').val('');
            $('.notif-email').removeClass('valid-email').removeClass('invalid-email').text('');
            $('.form-email-rest').removeClass('valid-email').removeClass('invalid-email');
            $('#btn-submit').attr('disabled', true);
        });
        $('.email-rest').on('input', function() {
            let formData = new FormData();
            formData.append('email', $('.email-rest').val());
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Auth/cek_email_rest_pass'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    action_email_rest(data)

                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        });

        $('#btn-submit').on('click', function() {
            let formData = new FormData();
            formData.append('email', $('.email-rest').val());
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Auth/ins_token_pass'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    // alert(data);
                    Swal.fire({
                        title: "Proses Berhasil !",
                        text: "Silakan periksa email Anda untuk mengubah kata sandi Anda",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed || result.dismiss === Swal.DismissReason.cancel) {
                            // Redirect to the appropriate URL after user interaction
                            $('.form-login').show(200);
                            $('.form-rest-pass').hide();
                            $('.title-form').text('Sign in');
                            $('.email-rest').val('');
                            $('.notif-email').removeClass('valid-email').removeClass('invalid-email').text('');
                            $('.form-email-rest').removeClass('valid-email').removeClass('invalid-email');
                            $('#btn-submit').attr('disabled', true);
                            window.open('https://mail.google.com/', '_blank');
                        }
                    });
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        });

        function action_email_rest(data) {
            if (data == 1) {
                $('.form-email-rest').addClass('valid-email').removeClass('invalid-email');
                $('.notif-email').addClass('valid-email').removeClass('invalid-email').text('Email ini tersedia !');
                $('#btn-submit').removeAttr('disabled', true);
            } else {
                $('.form-email-rest').addClass('invalid-email').removeClass('valid-email');
                $('.notif-email').addClass('invalid-email').removeClass('valid-email').text('Email ini tidak valid !');
                $('#btn-submit').attr('disabled', true);
            }
        }
        // show password
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
    </script>
</body>

</html>