<div class="header" id="header">
    <nav class="navbar container">
        <a href="<?=base_url('');?>" class="brand">
            <img src="<?=base_url('assets');?>/images/DD.png" alt="img-fluid" style="max-height: 3rem;">
        </a>
        <div class="menu" id="menu">
            <ul class="menu-list mb-0">
                <li class="menu-item btn-navigasi transaksi" data-menu="transaksi">
                    <a href="#" class="menu-link is-active">
                        <i class="fa-solid fa-tent-arrow-left-right"></i>
                        <span class="menu-name">Transaksi</span>
                    </a>
                </li>
                <li class="menu-item btn-navigasi" data-menu="tiket">
                    <a href="#" class="menu-link">
                        <i class="fa-solid fa-ticket"></i>
                        <span class="menu-name">Tiket</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fa-solid fa-user"></i>
                        <span class="menu-name">Akun</span>
                    </a>
                </li>
                <!-- <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-icon ion-md-contact"></i>
                        <?php
                        $id_customer = $this->input->cookie('session');
                        $service = "(SELECT * FROM customer WHERE email = '$id_customer')";
                        $query = $this->db->query($service);
                        foreach ($query->result() as $rows) {
                        ?>

                            <span class="menu-name">Account <?= $rows->email; ?></span>
                        <?php } ?>
                    </a>
                </li> -->
            </ul>
        </div>
    </nav>
</div>