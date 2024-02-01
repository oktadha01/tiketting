<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/alert.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/style.css">
    <!-- Bootstrap Core Css -->
    <title>Sign in & Sign up Form</title>
    <!-- <link rel="icon" href="" type="image/gif" sizes="25x12"> -->

</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form class="sign-in-form" action="<?= site_url('Auth/login_adm') ?>" method="post" method="POST">
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

                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fa fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required autofocus
                            autocomplete="current-email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="password" required autofocus
                            autocomplete="current-password" />
                        <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility('password')"></i>
                    </div>
                    <input type="submit" value="Login" class="btn solid " />
                    <p class="social-text">Informasi Tentang System Bisa Lihat Sosial Media dibawah ini</p>
                    <div class="social-media">
                        <a href="https://wa.me/6285876208194?text=Hallo%20Wisdil%20..." target="_blank"
                            class="social-icon">
                            <i class="fab fa-whatsapp" style="font-size:27px;"></i>
                        </a>
                        <a href="https://www.instagram.com/wisdil_com?igsh=MTd3YzdpaGVwNTFqaw==" target="_blank"
                            class="social-icon">
                            <i class="fab fa-instagram" style="font-size:27px;"></i>
                        </a>
                        <a href="#" class="social-icon" style="font-size:22px;">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-youtube" style="font-size:22px;"></i>
                        </a>
                    </div>
                </form>
                <form action="#" class="sign-up-form">
                    <h2 class="title">Soryy !!!!</h2>
                    <p class="social-text">Untuk Pengajuan Akun baru Silahkan Hubungi Admin Isi Form Via WA</p>
                    <div class="social-media">
                        <a href="https://api.whatsapp.com/send?phone=6289615139363&text=Halo%20Kak%20,%20Bisa%20di%20Bantu%20Untuk%20Membuat%20Akun%20admin%20,%3F%0AAgency : %0ANama : %0AEmail : %0AKontak : %0A"
                            class="social-icon" target="_blank">
                            <i class="fab fa-whatsapp" style="font-size:27px;"></i>
                        </a>
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

    <script>
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