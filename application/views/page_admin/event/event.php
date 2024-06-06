<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('User'); ?>"><i class="fa fa-microphone"></i></a>
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
                        <h2>Data Event</h2>
                    </div>
                    <div div class="d-lg-none d-md-none">
                        <div class="col-sm-12 d-flex flex-row-reverse mt-2 ml-0">
                            <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                                data-target="#tambah-data"><i class="fa fa-microphone"></i>
                                <span></span></button>
                        </div>
                    </div>
                    <div class="d-md-block d-none col-lg-12 col-md-12">
                        <div class="col-lg-12 col-md-12 col-sm-6 d-flex flex-row-reverse">
                            <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                                data-target="#tambah-data"><i class="fa fa-microphone"></i>
                                <span> &nbsp;Tambah Event</span></button>
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <table id="data-event" class="table table-bordered table-hover table-striped"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Poster</th>
                                    <!-- <th>Header</th> -->
                                    <th>Agency</th>
                                    <th>Event</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Due Booked</th>
                                    <th>Lokasi</th>
                                    <th>Kota</th>
                                    <th>Alamat</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>MC</th>
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
        <form id="event-baru" enctype="multipart/form-data" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-0">
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <label class="label-select2">Agency</label>
                            <select class="select2 w-100 select2" id="id-user" name="id_user" style="height: 40px;"
                                data-dropdown-parent="#tambah-data">
                                <option value="">-- Pilih Agency--</option>
                                <?php foreach ($option as $data) { ?>
                                <option value="<?= $data->id_user; ?>"><?= $data->agency; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="nm-event" name="nm_event" class="col-lg-12 ml-0 mr-0" required>
                                <label class="label-in">Nama event</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper mb-2">
                                <input data-provide="datepicker" data-date-autoclose="true" type="text" id="tgl-event"
                                    name="tgl_event" class="col-lg-12" required>
                                <label class="label-in">Tanggal</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <input type="time" class="col-lg-12 time24" id="jam-event" name="jam_event" required>
                                <label class="label-in">Jam</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input data-provide="datepicker" data-date-autoclose="true" type="text" id="due-book"
                                    name="batas_pesan" class="col-lg-12" required>
                                <label class="label-in">Due Booked</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="lokasi" name="lokasi" class="col-lg-12" required>
                                <label class="label-in">Lokasi</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <label class="label-select2">Kota</label>
                                <select class="select2 w-100" style="height:55px;" id="kota" name="kota"
                                    data-dropdown-parent="#tambah-data">
                                    <option value=''>-- Pilih Kota --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-wrapper">
                                <textarea type="text" id="alamat" name="alamat" class="col-lg-12"></textarea>
                                <label class="label-in">Alamat</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class=" col-md-6 mb-2">
                            <div class="input-wrapper">
                                <div class="input-wrapper ml-0 mr-0">
                                    <label class="label-select">Kategori Event</label>
                                    <select type="text" id="kategori_event" name="kategori_event" class="col-lg-12">
                                        <option value="">-- Pilih Kategori --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="mc" name="mc_by" class="col-lg-12" required>
                                <label class="label-in">MC</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-2">
                        <div class="col-md-12 mb-1">
                            <div class="input-wrapper">
                                <textarea type="text" id="deskripsi" name="desc_event" class="col-lg-12"
                                    value=""></textarea>
                                <label class="label-in">Deskripsi </label>
                            </div>
                        </div>
                    </div>
                    <div class=" row clearfix row mb-1 mt 2">
                        <div class="col-lg-6 col-md-6">
                            <div class="card mb-0">
                                <div class="header pt-2 pb-0">
                                    <label class="label-up">Upload Poster</label>
                                </div>
                                <div class="body pt-2">
                                    <input type="file" class="dropify" id="poster" name="poster">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-6">
                            <div class="card mb-0">
                                <div class="header pt-2 pb-0">
                                    <label class="label-up">Upload Header</label>
                                </div>
                                <div class="body pt-2">
                                    <input type="file" class="dropify" id="header" name="header">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan">
                        <span id="btn-text">Simpan</span>
                        <span id="loading-icon" class="loading" style="display:none;">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
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
            </div>
        </form>
    </div>
</div>
<!-- akhir Modal tambah-->

<!-- modal ubah-->
<div class="modal fade" id="ubah-event" tabindex="-1" role="dialog" aria-labelledby="ubah-event" aria-hidden="true"
    data-modal-parent="ubah-event">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" id="edit-event">
                <div class="modal-body mb-0">
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <label class="label-select2">Agency</label>
                            <select class="select2 w-100 select2" id="edit-id-user" name="id_user" style="height: 45px;"
                                data-dropdown-parent="#ubah-event">
                                <option value="">-- Pilih Agency--</option>
                                <?php foreach ($option as $data) { ?>
                                <option value="<?= $data->id_user; ?>"><?= $data->agency; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="text" id="edit-id-event" name="id_event" class="col-lg-12" hidden>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="edit-nm-event" name="nm_event" class="col-lg-12 ml-0 mr-0"
                                    required>
                                <label class="label-in">Nama event</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <div class="input-wrapper mb-2">
                                <input data-provide="datepicker" data-date-autoclose="true" type="text"
                                    id="edit-tgl-event" name="tgl_event" class="col-lg-12" required>
                                <label class="label-in">Tanggal</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <input type="time" class="col-lg-12 time24" id="edit-jam-event" name="jam_event"
                                    required>
                                <label class="label-in">Jam</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input data-provide="datepicker" data-date-autoclose="true" type="text"
                                    id="edit-due-book" name="batas_pesan" class="col-lg-12" required>
                                <label class="label-in">Due Booked</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="edit-lokasi" name="lokasi" class="col-lg-12" required>
                                <label class="label-in">Lokasi</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <label class="label-select2">Kota</label>
                                <select class="select2 w-100" style="height:55px;" id="edit-kota" name="kota"
                                    data-dropdown-parent="#ubah-event">
                                    <option value=''>-- Pilih Kota --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-wrapper">
                                <textarea type="text" id="edit-alamat" name="alamat" class="col-lg-12"></textarea>
                                <label class="label-in">Alamat</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class=" col-md-6 mb-2">
                            <div class="input-wrapper">
                                <div class="input-wrapper ml-0 mr-0">
                                    <label class="label-select">Kategori Event</label>
                                    <select type="text" id="edit-kategori-event" name="kategori_event"
                                        class="col-lg-12">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="edit-mc" name="mc" class="col-lg-12" required>
                                <label class="label-in">MC</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-2">
                        <div class="col-md-12 mb-1">
                            <div class="input-wrapper">
                                <textarea type="text" id="edit-deskripsi" name="desc_event" class="col-lg-12"
                                    value=""></textarea>
                                <label class="label-in">Deskripsi </label>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix row mb-1 mt-2">
                        <div class="col-lg-6 col-md-6">
                            <div class="card mb-0">
                                <div class="header pt-2 pb-0">
                                    <label class="label-up">Update Poster</label>
                                </div>
                                <div class="body pt-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit-poster"
                                            name="edit_poster">
                                    </div>
                                    <input type="hidden" id="poster-lama" value="" name="poster_lama">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-6">
                            <div class="card mb-0">
                                <div class="header pt-2 pb-0">
                                    <label class="label-up">Update Header</label>
                                </div>
                                <div class="body pt-2">
                                    <input type="hidden" id="header-lama" value="" name="header_lama">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit-header"
                                            name="edit_header">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal ubah -->