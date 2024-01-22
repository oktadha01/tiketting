<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Dashboard'); ?>"><i
                                class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item active"><?= $tittle?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix row-deck">
        <?php if ($userdata->privilage == 'Admin') : ?>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card top_widget primary-bg">
                <div class="body">
                    <div class="icon bg-light"><i class="fa fa-money"></i> </div>
                    <div class="content text-light">
                        <div class="text mb-2 text-uppercase">Saldo Xendit</div>
                        <h5 class="number mb-0"><span class="font-12">
                            </span><b style="color:red"> <?=$xendit; ?> </b></h5>
                        </h5>
                        <small>Analytics for last month</small>
                    </div>
                    <div class="sparkline text-left mt-3" data-type="bar" data-offset="100" data-width="100%"
                        data-height="40px" data-bar-Width="4" data-bar-Color="#ffffff">
                        2,9,8,7,4,4,6,7,3,4,9,1,5,1,7,8,4,2,1,4,1,2,4,6,7,8,3,2,1,2,5</div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($userdata->privilage == 'User') : ?>
        <div class="col-lg-3 col-md-6 col-sm-6 mr-0 pr-0">
            <div class="card top_widget primary-bg">
                <div class="body p-1 m-1">
                    <!-- <div class="icon bg-light "><i class="fa fa-money"></i> </div> -->
                    <div class="content text-light ">
                        <div class="text mb-2 text-uppercase">Saldo</div>
                        <h4 class="number mb-0"><span class="font-12">
                            </span><b style="color:red">Rp. 100.000.000 </b></h5>
                        </h4>
                        <small>Analytics for last month</small>
                    </div>
                    <div class="sparkline text-left mt-3" data-type="bar" data-offset="100" data-width="100%"
                        data-height="40px" data-bar-Width="4" data-bar-Color="#ffffff">
                        2,9,8,7,4,4,6,7,3,4,9,1,5,1,7,8,4,2,1,4,1,2,4,6,7,8,3,2,1,2,5</div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-lg-3 col-md-6 col-sm-6 mr-0 pr-0">
            <div class="card top_widget secondary-bg">
                <div class="body">
                    <div class="icon bg-light"><i class="fa fa-ticket"></i> </div>
                    <div class="content text-light">
                        <div class="text mb-2 text-uppercase">Total Tiket</div>
                        <h4 class="number mb-0">3,251 <span class="font-12"><i class="fa fa-level-up"></i>
                                11%</span></h4>
                        <small>Analytics for last month</small>
                    </div>
                    <div class="sparkline text-left mt-3" data-type="bar" data-offset="100" data-width="100%"
                        data-height="40px" data-bar-Width="4" data-bar-Color="#ffffff">
                        2,7,8,3,2,1,2,5,6,7,3,4,9,1,5,9,8,7,4,4,4,1,2,4,6,1,7,8,4,2,1</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mr-0 pr-0">
            <div class="card top_widget bg-dark">
                <div class="body">
                    <div class="icon bg-light"><i class="fa fa-ticket"></i> </div>
                    <div class="content text-light">
                        <div class="text mb-2 text-uppercase">Tiket Terjual</div>
                        <h4 class="number mb-0">3,251 <span class="font-12"><i class="fa fa-level-up"></i>
                                5.2%</span></h4>
                        <small>Analytics for last month</small>
                    </div>
                    <div class="sparkline text-left mt-3" data-type="bar" data-offset="100" data-width="100%"
                        data-height="40px" data-bar-Width="4" data-bar-Color="#ffffff">
                        2,9,8,7,4,4,4,9,1,5,1,7,8,4,2,1,4,1,2,4,6,7,8,3,2,1,2,5,6,7,3</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mr-0 pr-0">
            <div class="card top_widget bg-info">
                <div class="body">
                    <div class="icon bg-light"><i class="fa fa-ticket"></i> </div>
                    <div class="content text-light">
                        <div class="text mb-2 text-uppercase">Stok Tiket</div>
                        <h4 class="number mb-0">3,251 <span class="font-12"><i class="fa fa-level-up"></i>
                                3.8%</span></h4>
                        <small>Analytics for last month</small>
                    </div>
                    <div class="sparkline text-left mt-3" data-type="bar" data-offset="100" data-width="100%"
                        data-height="40px" data-bar-Width="4" data-bar-Color="#ffffff">
                        2,9,8,7,4,4,4,1,2,4,6,7,8,3,2,1,2,5,6,7,3,4,9,1,5,1,7,8,4,2,1</div>
                </div>
            </div>
        </div>
    </div>
</div>