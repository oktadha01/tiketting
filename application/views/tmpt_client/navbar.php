<div class="header" id="header">
    <nav class="navbar container">
        <a href="./index.html" class="brand">Brand</a>
        <div class="menu" id="menu">
            <ul class="menu-list">
                <li class="menu-item t-top">
                    <a href="#" class="menu-link is-active">
                        <i class="menu-icon ion-md-home"></i>
                        <span class="menu-name">Home</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-icon ion-md-search"></i>
                        <span class="menu-name">Search</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-icon ion-md-cart"></i>
                        <span class="menu-name">Cart</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-icon ion-md-heart"></i>
                        <span class="menu-name">Favorite</span>
                    </a>
                </li>
                <li class="menu-item">
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
                </li>
            </ul>
        </div>
    </nav>
    <div class="nav top">
        <div class="row bg-cornflowerblue">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <button class="close-top">close</button>
                    </div>
                    <div class="col-6">
                        <span class="float-right">Transaction</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="data-transaksi" class="row">
                <div class="card box-shadow">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-1 col-md-2 col-5">
                                <img src="<?= base_url('assets'); ?>/images/poster.png" class="img-fluid size-poster">
                            </div>
                            <div class="col-lg-8 col-md-10 col-7 p-table-inv">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div style="display:grid;">
                                            <span class="smal">Invoice Number</span>
                                            <span class="font-weight-bold">INV-#CB-12334-0001</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div style="display:grid;">
                                            <span class="smal">Buy At</span>
                                            <span class="font-weight-bold">Jan 5, 2024 | 11:39</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="display:grid;">
                                            <span class="smal">Total</span>
                                            <span class="font-weight-bold">Rp 100.100</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="display:grid;">
                                            <span class="smal">Status</span>
                                            <span class="font-weight-bold">Expired</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 p-table-inv">
                                <hr class="hr">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="col-12 btn btn-sm btn-info">Detail</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="col-12 btn btn-sm btn-info">Pay Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card box-shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1 col-md-2 col-5">
                                <img src="<?= base_url('assets'); ?>/images/poster.png" class="img-fluid size-poster">
                            </div>
                            <div class="col-lg-8 col-md-10 col-7 p-table-inv">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div style="display:grid;">
                                            <span class="smal">Invoice Number</span>
                                            <span class="font-weight-bold">INV-#CB-12334-0001</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div style="display:grid;">
                                            <span class="smal">Buy At</span>
                                            <span class="font-weight-bold">Jan 5, 2024 | 11:39</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="display:grid;">
                                            <span class="smal">Total</span>
                                            <span class="font-weight-bold">Rp 100.100</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="display:grid;">
                                            <span class="smal">Status</span>
                                            <span class="font-weight-bold">Expired</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 p-table-inv">
                                <hr class="hr">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="col-12 btn btn-sm btn-info">Detail</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="col-12 btn btn-sm btn-info">Pay Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>