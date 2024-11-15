<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Scan_tiket/data_scan'); ?>"><i
                                class="fa fa-ticket"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><?= $bread?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header mb-1 pb-1">
                    <h2>Data Tiket</h2>
                </div>
                <div class="input-group pb-0 col-lg-3 col-md-3 col-sm-12 mr-0 pr-0"
                    style="display: flex; align-items: center;">
                    <div class="form-group" style="flex: 1; margin-bottom: 0;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-qrcode"></i></span>
                            </div>
                            <select type="text" id="status_filter" class="form-control" style="height: 38px;">
                                <option value="">Pilih !!</option>
                                <option value="0">Belum Diambil</option>
                                <option value="1">Sudah Diambil</option>
                            </select>
                        </div>
                    </div>
                    <div class="demo-button" style="margin-left: 10px;">
                        <button type="button" class="btn btn-success" title="Export Excel" style="height: 38px;"
                            id="export-excel">
                            <span class="sr-only">Export Excel</span>
                            <i class="fa fa-file-excel-o"></i>
                        </button>
                    </div>
                </div>
                <div class="body table-responsive mt-1 pt-1">
                    <table id="data-tiket" class="table table-bordered table-hover table-striped mt-1 pt-1"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code Tiket</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Kontak</th>
                                <th>No. Identitas</th>
                                <th>Status</th>
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