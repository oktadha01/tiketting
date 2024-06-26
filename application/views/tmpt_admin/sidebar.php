<div id="left-sidebar" class="sidebar">
    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="<?= base_url('assets'); ?>/images/user/<?php echo $userdata->fot_profil; ?>"
                class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);"
                    class=" user-name"><strong><?= $this->session->userdata('userdata')->agency; ?></strong></a>
            </div>
            <hr>
        </div>
        <?php if ($userdata->privilage == 'Admin') : ?>
        <!-- Tab panes -->
        <div class="tab-content padding-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu li_animation_delay">
                        <li class="menu">
                            <a href="<?= site_url('dashboard'); ?>" class=""><i
                                    class="fa fa-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Event'); ?>" class=""><i
                                    class="fa fa-file-movie-o "></i><span>Event</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Perform'); ?>" class=""><i
                                    class="fa fa-weibo"></i><span>Perform</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Prices'); ?>" class=""><i
                                    class="fa fa-money"></i><span>Prices</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Scan_tiket/data_scan'); ?>" class="">
                                <i class="fa fa-ticket"></i><span> Data Scan Tiket</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Banner_upload'); ?>" class=""><i
                                    class="fa fa-flag"></i><span>Banner</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Article'); ?>" class=""><i class="fa fa-file-text"></i><span>
                                    Article</span></a>
                        </li>
                        <li class="menu active">
                            <a href="#setting" class="has-arrow"><i class="fa fa-gears"></i><span>Setting</span></a>
                            <ul class="submenu">
                                <li><a href="<?= site_url('User/user_adm'); ?>"
                                        class="<?= ($this->uri->segment(1) == 'User/user_adm') ? 'active' : ''; ?>">
                                        User</a>
                                </li>
                                <li><a href="<?= site_url('Xendit'); ?>"
                                        class="<?= ($this->uri->segment(1) == 'Xendit') ? 'active' : ''; ?>">API
                                        Xendit</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($userdata->privilage == 'User') : ?>
        <div class="tab-content padding-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu li_animation_delay">
                        <li class="menu">
                            <a href="<?= site_url('Dashboard'); ?>" class="">
                                <i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Event'); ?>" class="">
                                <i class="fa fa-file-movie-o "></i><span>Event</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Perform'); ?>" class="">
                                <i class="fa fa-weibo"></i><span>Perform</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Prices'); ?>" class="">
                                <i class="fa fa-money"></i><span>Prices</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Scan_tiket/data_scan'); ?>" class="">
                                <i class="fa fa-ticket"></i><span> Data Scan Tiket</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('Dana_masuk'); ?>" class="">
                                <i class="fa fa-money"></i><span>Transaksi</span></a>
                        </li>
                        <li class="menu">
                            <a href="<?= site_url('User/user_scan'); ?>" class="">
                                <i class="fa fa-users"></i><span>User Scan</span></a>
                        </li>
                        <!-- <li class="menu">
                            <a href="<?= site_url('Scan_tiket'); ?>" id="scanTiketButton" class=""><i
                                    class="fa fa-qrcode"></i><span>Scan Tiket</span>
                            </a>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($userdata->privilage == 'scan') : ?>
        <div class="tab-content padding-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu li_animation_delay">
                        <li class="menu">
                            <a href="<?= site_url('Scan_tiket'); ?>" class=""><i class="fa fa-qrcode"></i><span>Scan
                                    Tiket</span>
                            </a>
                        </li>
                        <!-- <li class="menu">
                            <a href="<?= site_url(''); ?>" class=""><i class="fa fa-barcode"></i><span>Scan
                                    Masuk</span></a>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>