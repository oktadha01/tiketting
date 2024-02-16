<div class="header" id="header">
    <nav class="navbar container">
        <a href="<?= base_url(''); ?>" class="brand">
            <img src="<?= base_url('assets'); ?>/images/DD.png" alt="img-fluid" style="max-height: 3rem;">
        </a>
        <div class="menu" id="menu">
            <ul class="menu-list mb-0">
                <?php if ($this->input->cookie('session') == '') { ?>
                    <li class="menu-item ">
                        <a href="<?= base_url('Auth'); ?>" class="menu-link">
                            <img class="siz-menu" src="<?= base_url('assets/images/Login.png'); ?>" alt="">
                            <span class="menu-name mr-2"> Login </span>
                        </a>
                    </li>
                <?php } else { ?>

                    <li class="menu-item btn-navigasi transaksi" data-menu="transaksi">
                        <a href="#" class="menu-link">
                            <img class="siz-menu" src="<?= base_url('assets/images/transaksi.png'); ?>" alt="">
                            <span class="menu-name">Transaksi</span>
                        </a>
                    </li>
                    <li class="menu-item btn-navigasi" data-menu="tiket">
                        <a href="#" class="menu-link">
                            <img class="siz-menu" src="<?= base_url('assets/images/tiket.png'); ?>" alt="">
                            <span class="menu-name">Tiket</span>
                        </a>
                    </li>
                    <li class="menu-item menu-akun">
                        <a href="<?= base_url('Userprofil'); ?>" class="menu-link">
                            <img class="siz-menu" src="<?= base_url('assets/images/akun.png'); ?>" alt="">
                            <span class="menu-name">Akun</span>
                        </a>
                    </li>
                    <li class="menu-item menu-akun-drop dropdown show">
                        <a href="#" class="menu-link dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="siz-menu" src="<?= base_url('assets/images/akun.png'); ?>" alt="">
                            <span class="menu-name">Akun</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php
                            $id_customer = $this->input->cookie('session');
                            $service = "(SELECT * FROM customer WHERE email = '$id_customer')";
                            $query = $this->db->query($service);
                            foreach ($query->result() as $rows) {
                            ?>

                                <span class="dropdown-text">Hello,</span>
                                <h6 class="dropdown-text"><?= $rows->nm_customer; ?></h6>
                            <?php } ?>
                            <hr class="m-0">
                            <a class="dropdown-item" href="<?= base_url('Userprofil'); ?>">Edit Profil</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#modal-pass">Ganti Passwor</a>
                            <a class="dropdown-item text-danger" href="<?= base_url('Auth/logout'); ?>">Logout</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>