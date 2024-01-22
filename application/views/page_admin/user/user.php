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
                        <h2>Data User</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                            data-target="#tambah-data"><i class="fa fa-smile-o"></i>
                            <span> &nbsp;Tambah User</span></button>
                    </div>
                    <div class="body table-responsive">
                        <table id="data-user" class="table table-bordered table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width='20%'>Agency</th>
                                    <th width='30%'>Nama</th>
                                    <th width='70%'>Alamat</th>
                                    <th width='20%'>Email</th>
                                    <th width='15%'>Kontak</th>
                                    <th width='15%'>Privilage</th>
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
                <!-- <li class="header"><strong>You have 4 new Notifications</strong></li> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user-baru">
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="agency" class="col-lg-12" required>
                                <label class="label-in">Agency</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="nama" class="col-lg-12" required>
                                <label class="label-in">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="email" id="email" class="col-lg-12" required>
                                <label class="label-in">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="kontak" class="col-lg-12">
                                <label class="label-in">Kontak</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="password" id="password" class="col-lg-12" required
                                    autocomplete="current-password">
                                <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility('password')"></i>
                                <label class="label-in">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label class="label-select">Privilage</label>
                                <select type="text" id="privilage" class="col-lg-12" required>
                                    <option value="">Pilih Privilage</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-1">
                        <div class=" col-md-12 col-sm-12 mb-1">
                            <div class="input-wrapper">
                                <textarea class="form-control" id="alamat" rows="5" cols="30" required></textarea>
                                <label class="label-in">Alamat</label>
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
<div class="modal fade" id="ubah-user" tabindex="-1" role="dialog" aria-labelledby="tambah-data" aria-hidden="true"
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
                <form id="ubah-user">
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="data-id" name="id_user" class="col-lg-12" hidden>
                                <input type="text" id="data-agency" name="agency" class="col-lg-12">
                                <label class="label-in">Agency</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="data-nama" name="nm_user" class="col-lg-12">
                                <label class="label-in">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="email" id="data-email" name="email" class="col-lg-12">
                                <label class="label-in">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="data-kontak" name="kontak" class="col-lg-12">
                                <label class="label-in">Kontak</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="data-password" name="password" class="col-lg-12">
                                <label class="label-in">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label class="label-select">Privilage</label>
                                <select type="text" id="data-privilage" name="privilage" class="col-lg-12">
                                    <option value="">Pilih Privilage</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-1">
                        <div class=" col-md-12 col-sm-12 mb-1">
                            <div class="input-wrapper">
                                <textarea class="form-control" id="data-alamat" name="alamat" rows="5" cols="30"
                                    required></textarea>
                                <label class="label-in">Alamat</label>
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