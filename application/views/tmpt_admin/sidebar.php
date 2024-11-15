<style>
    .text-active {
        color: blue;
        font-weight: bold;
        /* text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); */
    }
</style>
<div id="left-sidebar" class="sidebar">
    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="<?= base_url('assets'); ?>/images/user/<?php echo $userdata->fot_profil; ?>"
                class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <?php 
                ?>
                <a href="javascript:void(0);" class=" user-name">
                    <strong><?= $this->session->userdata('userdata')->agency; ?></strong>
                </a>
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
                                <a href="<?= base_url('dashboard'); ?>" class=""><i
                                        class="fa fa-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Event'); ?>" class=""><i
                                        class="fa fa-file-movie-o "></i><span>Event</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Perform'); ?>" class=""><i
                                        class="fa fa-weibo"></i><span>Perform</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Prices'); ?>" class=""><i
                                        class="fa fa-money"></i><span>Prices</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Scan_tiket/data_scan'); ?>" class="">
                                    <i class="fa fa-ticket"></i><span> Data Scan Tiket</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Banner_upload'); ?>" class=""><i
                                        class="fa fa-flag"></i><span>Banner</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Article'); ?>" class=""><i class="fa fa-file-text"></i><span>
                                        Article</span></a>
                            </li>
                            <li class="menu active">
                                <a href="#setting" class="has-arrow"><i class="fa fa-gears"></i><span>Setting</span></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="<?= base_url('Internet_fee'); ?>"
                                            class="<?= ($this->uri->segment(1) == 'Internet_fee') ? 'active' : ''; ?>">
                                            <span
                                                class="<?= ($this->uri->segment(1) == 'Internet_fee') ? 'text-active' : ''; ?>">Internet
                                                Fee</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('User/user_adm'); ?>"
                                            class="<?= ($this->uri->segment(2) == 'user_adm') ? 'active' : ''; ?>">
                                            <span
                                                class="<?= ($this->uri->segment(2) == 'user_adm') ? 'text-active' : ''; ?>">User</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Xendit'); ?>"
                                            class="<?= ($this->uri->segment(1) == 'Xendit') ? 'active' : ''; ?>">
                                            <span
                                                class="<?= ($this->uri->segment(1) == 'Xendit') ? 'text-active' : ''; ?>">API
                                                Xendit</span>
                                        </a>
                                    </li>
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
                                <a href="<?= base_url('Dashboard'); ?>" class="">
                                    <i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Event'); ?>" class="">
                                    <i class="fa fa-file-movie-o "></i><span>Event</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Perform'); ?>" class="">
                                    <i class="fa fa-weibo"></i><span>Perform</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Prices'); ?>" class="">
                                    <i class="fa fa-money"></i><span>Prices</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Scan_tiket/data_scan'); ?>" class="">
                                    <i class="fa fa-ticket"></i><span> Data Scan Tiket</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Sales_tiket'); ?>" class="">
                                    <i class="fa fa-shopping-basket"></i><span>Penjualan Tiket</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Dana_masuk'); ?>" class="">
                                    <i class="fa fa-money"></i><span>Transaksi</span></a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('User/user_scan'); ?>" class="">
                                    <i class="fa fa-users"></i><span>User Scan</span></a>
                            </li>
                            <!-- <li class="menu">
                            <a href="<?= base_url('Scan_tiket'); ?>" id="scanTiketButton" class=""><i
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
                                <a href="<?= base_url('Scan_tiket'); ?>" class=""><i class="fa fa-qrcode"></i><span>Scan
                                        Tiket</span>
                                </a>
                            </li>
                            <!-- <li class="menu">
                            <a href="<?= base_url(''); ?>" class=""><i class="fa fa-barcode"></i><span>Scan
                                    Masuk</span></a>
                                </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($userdata->privilage == 'sales') : ?>
            <div class="tab-content padding-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu li_animation_delay">
                            <li class="menu">
                                <a href="<?= base_url('Dash_sales'); ?>" class=""><i class="fa fa-dashboard"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Transaksi_event_sales'); ?>" class=""><i class="fa-solid fa-money-bill-transfer"></i>
                                    <span>Transaksi</span>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Withdrawal'); ?>" class=""><i class="fa-solid fa-hand-holding-dollar"></i>
                                    <span>Withdrawal</span>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="<?= base_url('Histori_withdrawal'); ?>" class=""><i class="fa-solid fa-clock-rotate-left"></i>
                                    <span>Histori</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>