<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Dana_masuk'); ?>"><i class="fa fa-money"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><?= $bread?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Penjualan Tiket</h2>
                    </div>
                    <div class="body table-responsive">
                        <table id="data-sales" class="table table-bordered table-hover table-striped"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th width='8%'>No</th>
                                    <th width='20%'>Tanggal</th>
                                    <th width='20%'>Customer</th>
                                    <th width='30%'>Code Pembayaran</th>
                                    <th width='30%'>Jumlah Tiket</th>
                                    <th width='15%'>Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="l-parpl text-right" style="font-weight: bold;">Total
                                        Tiket:
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>