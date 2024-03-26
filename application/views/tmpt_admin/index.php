<?php $this->load->view('tmpt_admin/header'); ?>

<body data-theme="light" class="font-nunito">
    <div id="wrapper" class="theme-blue">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="<?= base_url('assets/images/loader/logo.png') ?>" width="70" height="48"
                        alt="Iconic"></div>
                <p>Please wait...</p>
            </div>
        </div>
        <?php $this->load->view('tmpt_admin/navbar'); ?>
        <?php $this->load->view('tmpt_admin/sidebar'); ?>
        <div id="main-content">
            <div class="container-fluid">
                <?php $this->load->view($content); ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('tmpt_admin/footer'); ?>
    <?php $this->load->view($script); ?>

</body>