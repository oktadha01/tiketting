<?php $this->load->view('templates/header'); ?>

<body data-theme="light" class="font-nunito">
    <div id="wrapper" class="theme-cyan">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="assets/images/logo-icon.svg" width="48" height="48" alt="Iconic"></div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- Top navbar div start -->
        <?php $this->load->view('templates/navbar'); ?>
        <!-- main left menu -->
        <?php $this->load->view('templates/sidebar'); ?>
        <!-- mani page content body part -->
        <div id="main-content" class="">
            <div class="container-fluid">
                <?php $this->load->view($content); ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
    <?php $this->load->view($script); ?>
    
</body>