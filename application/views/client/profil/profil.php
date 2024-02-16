<section class="container" style="margin-top: 6rem;height: 100vh;">
    <div class="card">
        <div class="card-header">
            <h5>Profil</h5>
        </div>
        <div class="card-body">
            <?php foreach ($customer as $data) { ?>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" class="form-control" required="" readonly value="<?= $data->nm_customer; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" id="tgl-lahir" class="form-control" required="" readonly value="<?= $data->tgl_lahir; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <br>
                            <label class="fancy-radio">
                                <input type="radio" id="gender-male" class="gender" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender" disabled>
                                <span><i></i>Male</span>
                            </label>
                            <label class="fancy-radio">
                                <input type="radio" id="gender-female" class="gender" name="gender" value="female" data-parsley-multiple="gender" disabled>
                                <span><i></i>Female</span>
                            </label>
                            <p id="error-radio"></p>
                            <input type="text" id="val-gender" value="<?= $data->gender; ?>" hidden>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" id="nik" class="form-control" required="" readonly value="<?= $data->no_identitas; ?>">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="input-wrapper">
                            <label class="label-select2">Kota</label>
                            <select class="select2 form-control select-kota" id="kota" required="" disabled data-value="<?= $data->kota; ?>">
                                <option value=''>-- Pilih Kota --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" id="kontak" class="form-control" required="" readonly value="<?= $data->kontak; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button id="btn-edit-profil" class="col-12 btn bg-w-orange float-right">Edit Profil</button>
                    </div>
                    <div class="col-6">
                        <button id="btn-batal-edit-profil" class="btn btn-danger text-light" hidden>Batal Edit</button>
                    </div>
                    <div class="col-6">
                        <button id="btn-simpan-profil" class="btn bg-w-blue text-light float-right" hidden>Simpan Profil</button>
                    </div>
                </div>
                <div class="row ubah-email mb-2">
                    <div class="col">
                        <hr>
                        <span class="btn-ubah-email" data-email="<?= $data->email; ?>" data-toggle="modal" data-target="#modal-email">Ubah Email ></span>
                        <span class="float-right text-email"><?= $data->email; ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="col-12" id="notif-email"></p>
                    </div>
                </div>
                <div class="row ubah-password mb-2">
                    <div class="col">
                        <hr>
                        <span class="btn-ubah-password" data-action="page" data-toggle="modal" data-target="#modal-pass">Ubah Password ></span>
                        <span class="float-right">*******</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="col-12" id="notif-pass"></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- <div class="card-footer"> -->

        <!-- </div> -->
    </div>
    <div class="row row-btn-logout">
        <div class="col">
            <a href="<?= base_url('Auth/logout'); ?>">
                <button class="btn btn-danger col-12">Logout</button>
            </a>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-email" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Ubah Email</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Ubah Email Baru</label>
                            <input type="email" id="email" class="form-control email-baru" required="">
                            <span class="valid_info"></span>
                        </div>
                    </div>
                    <div class="col-12 col-pass">
                        <div class="form-group">
                            <label>Validasi Password</label>
                            <input type="password" id="password" class="form-control" required="">
                            <span class="valid_pass"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                <button type="button" id="btn-simpan-email" class="btn bg-w-blue text-light">Simpan Email</button>
            </div>
        </div>
    </div>
</div>