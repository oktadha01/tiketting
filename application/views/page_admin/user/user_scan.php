<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('User'); ?>"><i class="fa fa-smile-o"></i></a>
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
                        <h2>Data User Scan</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                            data-target="#tambah-data"><i class="fa fa-smile-o"></i>
                            <span> &nbsp;Tambah User</span></button>
                    </div>
                    <div class="body table-responsive">
                        <table id="user-scan" class="table table-bordered table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width='20%'>Event</th>
                                    <th width='30%'>Nama</th>
                                    <th width='20%'>Email</th>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user-baru">
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <div class="input-wrapper ml-0 mr-0">
                                    <label class="label-select">Event</label>
                                    <select type="text" id="options_event" name="event" class="col-lg-12">
                                        <option value="">-- Pilih Event --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="email" id="email" class="col-lg-12" required>
                                <label class="label-in">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="nama" class="col-lg-12" required>
                                <input type="text" id="agency" class="col-lg-12"
                                    value="<?= $this->session->userdata('userdata')->agency; ?>" hidden>
                                <label class="label-in">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="password" id="password" class="col-lg-12" required
                                    autocomplete="current-password">
                                <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility('password')"></i>
                                <label class="label-in">Password</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="btn-simpan">
                    <span id="btn-text">Simpan</span>
                    <span id="loading-icon" class="loading" style="display:none;">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                            <rect x="11" y="6" rx="1" width="2" height="7">
                                <animateTransform attributeName="transform" type="rotate" dur="9s"
                                    values="0 12 12;360 12 12" repeatCount="indefinite" />
                            </rect>
                            <rect x="11" y="11" rx="1" width="2" height="9">
                                <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                    values="0 12 12;360 12 12" repeatCount="indefinite" />
                            </rect>
                        </svg> Loading...
                    </span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal tambah-->

<!-- modal ubah-->
<div class="modal fade" id="ubah-userScan" tabindex="-1" role="dialog" aria-labelledby="tambah-data" aria-hidden="true"
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
                <form id="ubah-scan">
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <div class="input-wrapper ml-0 mr-0">
                                    <label class="label-select">Event</label>
                                    <select type="text" id="options_event-edit" name="event" class="col-lg-12">
                                        <option value="">-- Pilih Event --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="email" id="data-email" class="col-lg-12">
                                <input type="text" id="id-user" class="col-lg-12" hidden>
                                <label class="label-in">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="data-nama" class="col-lg-12" required>
                                <input type="text" id="data-agency" class="col-lg-12" hidden>
                                <label class="label-in">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="scan-password" class="col-lg-12" required
                                    autocomplete="current-password">
                                <label class="label-in">Password</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btn-ubah">
                    <span id="btn-text-edit">Ubah</span>
                    <span id="loading-icon-edit" class="loading" style="display:none;">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                            <rect x="11" y="6" rx="1" width="2" height="7">
                                <animateTransform attributeName="transform" type="rotate" dur="9s"
                                    values="0 12 12;360 12 12" repeatCount="indefinite" />
                            </rect>
                            <rect x="11" y="11" rx="1" width="2" height="9">
                                <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                    values="0 12 12;360 12 12" repeatCount="indefinite" />
                            </rect>
                        </svg> Loading...
                    </span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal ubah -->