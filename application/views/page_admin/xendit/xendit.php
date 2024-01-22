<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Xendit'); ?>"><i class="fa fa-gears"></i></a>
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
                        <h2>Data Key Xendit</h2>
                    </div>
                    <div class="body table-responsive">
                        <table id="data-xendit" class="table table-bordered table-hover table-striped"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width='30%'>Nama Key</th>
                                    <th width='70%'>Value Key</th>
                                    <th width='20%'>Akun</th>
                                    <th width='20%'>Status</th>
                                    <th width='20%'>Action</th>
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
</div>

<!-- modal ubah-->
<div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="tambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah API Xendit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="setting">
                    <div class=" row mb-3">
                        <div class="col-md-12 mb-3">
                            <div class="input-wrapper">
                                <input type="text" id="id" name="id" class="col-lg-12" hidden>
                                <input type="text" id="name" name="name" class="col-lg-12">
                                <label class="label-in">Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-wrapper">
                                <textarea class="form-control" id="value" name="value" rows="5" cols="30"
                                    required></textarea>
                                <label class="label-in">Value Key</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <label class="label-select">Akun</label>
                            <select type="text" id="akun" name="akun" class="col-lg-12">
                                <option value="">Pilih Type Akun</option>
                                <option value="0">Demo</option>
                                <option value="1">Live</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="label-select">Akun</label>
                            <select type="text" id="status" name="status" class="col-lg-12">
                                <option value="">Pilih Status</option>
                                <option value="0">Non Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal ubah -->