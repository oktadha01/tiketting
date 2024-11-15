<style>
    .dibayar {
        background: gray;
        padding: 3px 8px;
        font-weight: bold;
        color: white;
        border-radius: 8px
    }

    .diproses {
        background: orange;
        padding: 3px 8px;
        font-weight: bold;
        color: white;
        border-radius: 8px
    }

    .blm-ditarik {
        background: green;
        padding: 3px 8px;
        font-weight: bold;
        color: white;
        border-radius: 8px
    }
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
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Data Transaksi Event</h2>
                </div>
                <div class="body table-responsive">
                    <table id="data-transaksi" class="table table-bordered table-hover table-striped"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width=''>Event</th>
                                <th width=''>Tanggal</th>
                                <th width=''>Transaksi</th>
                                <th width=''>Profit</th>
                                <th width=''>Status Profit</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>