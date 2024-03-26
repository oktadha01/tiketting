<?php $this->load->view('tmpt_client/header'); ?>
<style>
    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background-color: #ebebeb;
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #6d6d6d;
    }
</style>

<?php $this->load->view('tmpt_client/navbar'); ?>
<?php $this->load->view('tmpt_client/slide_navigasi'); ?>

<body data-theme="light" class="font-nunito">
    <div id="wrapper" class="theme-cyan">
        <!-- Page Loader -->
        <!-- <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="assets/images/logo-icon.svg" width="48" height="48" alt="Iconic"></div>
                <p>Please wait...</p>
            </div>
        </div> -->
        <!-- Top navbar div start -->
        <!-- main left menu -->
        <!-- mani page content body part -->
        <!-- <div id="main-content" class=""> -->
        <!-- <div class="container-fluid"> -->
        <?php $this->load->view($content); ?>
        <!-- </div> -->
        <!-- </div> -->
    </div>
    <input type="text" id="eventclick" value="" hidden>

    
    <?php $this->load->view('tmpt_client/footer'); ?>
    <?php $this->load->view($script); ?>

</body>