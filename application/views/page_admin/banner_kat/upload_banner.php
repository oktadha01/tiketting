<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Banner_upload'); ?>"><i
                                class="fa fa-flag"></i></a>
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
                    <div class="col-lg-6 col-sm-12">
                        <h2>Data Banner</h2>
                    </div>
                    <div div class="d-lg-none d-md-none">
                        <div class="col-sm-12 d-flex flex-row-reverse mt-2 ml-0">
                            <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                                data-target="#tambah-data"><i class="fa fa-flag"></i>
                                <span></span></button>
                        </div>
                    </div>
                    <div class="d-md-block d-none col-lg-12 col-md-12">
                        <div class="col-lg-12 col-md-12 col-sm-6 d-flex flex-row-reverse">
                            <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                                data-target="#tambah-data"><i class="fa fa-flag"></i>
                                <span> &nbsp;Tambah Banner</span></button>
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <table id="data-banner" class="table table-bordered table-hover table-striped"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th width='15%'>No</th>
                                    <th width='35%'>Header Banner</th>
                                    <th>Action</th>
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

<!-- modal tambah-->
<div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="banner-baru" enctype="multipart/form-data" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-0">
                    <div class=" row clearfix row mb-1 mt 2">
                        <div class="col-lg-12 col-md-12">
                            <div class="card mb-0">
                                <div class="header pt-2 pb-0">
                                    <label class="label-up">Upload Header</label>
                                </div>
                                <div class="body pt-2">
                                    <input type="file" class="dropify" id="header" name="header">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- akhir Modal tambah-->

<!-- modal ubah-->
<div class="modal fade" id="ubah-banner" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="edit-banner" enctype="multipart/form-data" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-0">
                    <div class=" row clearfix row mb-1 mt 2">
                        <div class="col-lg-12 col-md-12">
                            <div class="card mb-0">
                                <div class="header pt-2 pb-0">
                                    <label class="label-up">Update Header</label>
                                </div>
                                <input type="text" id="edit-id-banner" name="id_banner" class="col-lg-12" hidden>
                                <div class="body pt-2">
                                    <input type="hidden" id="header-lama" value="" name="header_lama">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit-header"
                                            name="edit_header">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- akhir Modal ubah-->