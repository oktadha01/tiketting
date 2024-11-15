<style>

</style>
<div class="block-header">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h2><?= $bread; ?></h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('Dashboard'); ?>"><i
                            class="fa fa-dashboard"></i></a></li>
                <li class="breadcrumb-item active"><?= $bread ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-12">
        <ul class="d-flex list-unstyled box--shadow ul-border">
            <li class="li-border-icon">
                <i class="fa fa-file-movie-o "></i>
            </li>
            <li>
                <span class="font-weight-bold">Total Event</span>
                <br>
                <h3 class="text-primary font-weight-bold"><?= $total_event; ?></h3>
            </li>
        </ul>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <ul class="d-flex list-unstyled box--shadow ul-border">
            <li class="li-border-icon">
                <i class="fa-solid fa-money-bill-transfer"></i>
            </li>
            <li>
                <span class="font-weight-bold">Total transaksi</span>
                <br>
                <h3 class="text-primary font-weight-bold"><?= $total_transaksi; ?></h3>
            </li>
        </ul>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <ul class="d-flex list-unstyled box--shadow ul-border">
            <li class="li-border-icon">
                <i class="fa-solid fa-sack-dollar"></i>
            </li>
            <li>
                <span class="font-weight-bold">Total Profit</span>
                <br>
                <h3 class="text-primary font-weight-bold">Rp. <?= number_format($total_profit, 0, ',', '.'); ?></h3>
            </li>
        </ul>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <ul class="d-flex list-unstyled box--shadow ul-border">
            <li class="li-border-icon">
                <i class="fa-solid fa-sack-dollar"></i>
            </li>
            <li>
                <span class="font-weight-bold">Dalam Proses Penarikan</span>
                <br>
                <h3 class="text-primary font-weight-bold">Rp. <?= number_format($total_profit, 0, ',', '.'); ?></h3>
            </li>
        </ul>
    </div>
</div>