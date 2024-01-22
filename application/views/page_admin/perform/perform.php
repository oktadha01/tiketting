<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Perform'); ?>"><i class="fa fa-weibo"></i></a>
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
                        <h2>Data Perform</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                            data-target="#tambah-data"><i class="fa fa-weibo"></i>
                            <span> &nbsp;Tambah Perform</span></button>
                    </div>
                    <div class="body table-responsive">
                        <table id="data-perform" class="table table-bordered table-hover table-striped"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width='20%'>Event</th>
                                    <th width='30%'>Nama Artis</th>
                                    <th width='70%'>Status Perform</th>
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

<!-- modal tambah-->
<div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Perform</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="perform-baru">
                    <div class=" row mb-3">
                        <div class="col-md-12 mb-2">
                            <div class="input-wrapper">
                                <label class="label-select2">Event</label>
                                <select class="select2 w-100" style="height:55px;" id="id-event" name="id_event"
                                    data-dropdown-parent="#tambah-data">
                                    <option value=''>-- Pilih Event --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="nama-artis" class="col-lg-12" required>
                                <label class="label-in">Nama Artis</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <div class="input-wrapper ml-0 mr-0">
                                    <label class="label-select">Status Perform</label>
                                    <select type="text" id="status-perform" name="status_perform" class="col-lg-12">
                                        <option value="">Pilih Status</option>
                                        <option value="1">Special Perfomence</option>
                                        <option value="2">Also Perfoming </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal tambah-->

<!-- modal ubah-->
<div class="modal fade" id="ubah-perform" tabindex="-1" role="dialog" aria-labelledby="tambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubah-perform">
                    <div class=" row mb-3">
                        <div class="col-md-12 mb-2">
                            <div class="input-wrapper">
                                <label class="label-select2">Event</label>
                                <select class="select2 w-100" style="height:55px;" id="edit-id-event" name="id_event"
                                    data-dropdown-parent="#tambah-data">
                                    <option value=''>-- Pilih Event --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="id-perform" class="col-lg-12" hidden>
                                <input type="text" id="edit-nama-artis" class="col-lg-12" required>
                                <label class="label-in">Nama Artis</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <div class="input-wrapper ml-0 mr-0">
                                    <label class="label-select">Status Perform</label>
                                    <select type="text" id="edit-status-perform" name="status_perform"
                                        class="col-lg-12">
                                        <option value="">Pilih Status</option>
                                        <option value="1">Special Perfomence</option>
                                        <option value="2">Also Perfoming </option>
                                    </select>
                                </div>
                            </div>
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