<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Prices'); ?>"><i class="fa fa-money"></i></a>
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
                        <h2>Data Prices</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                            data-target="#tambah-data"><i class="fa fa-money"></i>
                            <span> &nbsp;Tambah Price</span></button> &nbsp; &nbsp;
                        <button type="button" class="btn btn-secondary shadow rounded" data-toggle="modal"
                            data-target="#bundling" data-id-event-bundle="<?= $this->uri->segment(3); ?>">
                            <i class="fa fa-suitcase"></i>
                            <span> &nbsp; Buat Bundling</span>
                        </button>
                        <a href="<?= site_url('Custom_tiket/kastemisasi/' . $this->uri->segment(3)); ?>"
                            class="btn btn-info shadow rounded mr-2">
                            <i class="fa fa-credit-card"></i>
                            <span> &nbsp; Kastemasi Tiket</span>
                        </a>

                    </div>
                    <div class="body table-responsive">
                        <table id="data-price" class="table table-bordered table-hover table-striped"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Event</th>
                                    <th>Kategori Harga</th>
                                    <th>Harga</th>
                                    <th>Stock Tiket</th>
                                    <th>Promo Berakhir</th>
                                    <th>Status</th>
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambah-data">
                <div class="modal-body">
                    <div class=" row mb-3">
                        <input type="text" id="id-event" name="id_event" class="col-lg-12"
                            value="<?= $this->uri->segment(3); ?>" required hidden>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-5">
                            <div class="input-wrapper">
                                <input type="text" id="kategori-price" class="col-lg-12" required>
                                <label class="label-in">Kategori Harga</label>
                            </div>
                        </div>
                        <div class="col-md-7 pl-0">
                            <div class="input-wrapper">
                                <input type="number" id="harga" class="col-lg-12" required>
                                <label class="label-in">Harga</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-2 mr-1 pr-1">
                        <div class="col-md-5 mr-0 pr-0 ">
                            <div class="input-wrapper">
                                <input type="number" id="stock-tiket" class="col-lg-12" required>
                                <label class="label-in">Stock Tiket</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2 pr-2 pl-2 mr-0 pr-0" id="promo-status" style="display: none;">
                            <label class="fancy-checkbox ml-1 mt-2">
                                <input type="checkbox" name="checkbox" id="status" onchange="perbaruiStatus()">
                                <span>Promo</span>
                            </label>
                        </div>
                        <div class="col-md-4 mb-2 pl-0 pr-0" id="promo-kelipatan" style="display: none;">
                            <label class="fancy-checkbox ml-1 mt-2">
                                <input type="checkbox" name="checkbox" id="promo-kel" onchange="togglePromoFields()">
                                <span>Promo Kelipatan</span>
                            </label>
                        </div>
                    </div>
                    <ul class="list-unstyled feeds_widget" id="due-kategori-container" style="display: none;">
                        <li>
                            <div class="row mt-1">
                                <div class="col-md-6 mb-2">
                                    <div class="input-wrapper" id="due-kategori">
                                        <input data-provide="datepicker" data-date-autoclose="true" type="text"
                                            id="akhir-promo" name="akhir_promo" class="col-lg-12">
                                        <label class="label-in">Akhir Promo</label>
                                    </div>
                                </div>

                                <div class="col-md-3 pr-0">
                                    <div class="input-wrapper" id="buy" style="display: none;">
                                        <label for=" buy-input" class="label-in">Buy</label>
                                        <input type="number" id="buy-input" class="col-lg-12" min="1" max="5"
                                            oninput="checkInput()">
                                    </div>
                                </div>

                                <div class="col-md-3 pl-0">
                                    <div class="input-wrapper" id="free" style="display: none;">
                                        <input type="number" id="free-input" class="col-lg-12" min="1" max="3"
                                            oninput="checkInput()">
                                        <label class="label-in" for="free-input">Free</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6 text-danger pl=0 pr=0 text-center" id="warning"
                                    style="display: none;">
                                    <span style="font-size: 10px; font-weight: bold;">Promo kelipatan max
                                        buy= 5 & free= 3 </span>
                                </div>

                            </div>
                        </li>
                    </ul>
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
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal tambah-->

<!-- modal ubah-->
<div class="modal fade" id="ubah-harga" tabindex="-1" role="dialog" aria-labelledby="tambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ubah-price">
                <div class="modal-body">
                    <div class=" row mb-3">
                        <div class="col-md-12 mb-2">
                            <div class="input-wrapper" hidden>
                                <label class="label-select2">Event</label>
                                <select class="select2 w-100" style="height:55px;" id="edit-id-event" name="id_event"
                                    data-dropdown-parent="#tambah-data">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3 mt-1 pt-0">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="id-price" class="col-lg-12" hidden>
                                <input type="text" id="edit-kategori-price" class="col-lg-12" required>
                                <label class="label-in">Kategori Harga</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="number" id="edit-harga" class="col-lg-12" required>
                                <label class="label-in">Harga</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-5 mr-0 pr-0 ">
                            <div class="input-wrapper">
                                <input type="number" id="edit-stock-tiket" class="col-lg-12" required>
                                <label class="label-in">Stock Tiket</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2 pr-2 pl-2 mr-0 pr-0" id="promo-status-edit" style="display: none;">
                            <label class="fancy-checkbox ml-1 mt-2">
                                <input type="checkbox" name="checkbox" id="edit-status" onchange="perbaruiStatusedit()">
                                <span>Promo</span>
                            </label>
                        </div>
                        <div class="col-md-4 mb-2 pl-0 pr-0" id="edit-promo-kelipatan" style="display: none;">
                            <label class="fancy-checkbox ml-1 mt-2">
                                <input type="checkbox" name="checkbox" id="edit-promo-kel"
                                    onchange="perbaruipromokel()">
                                <span>Promo Kelipatan</span>
                            </label>
                        </div>
                    </div>
                    <ul class="list-unstyled feeds_widget" id="due-kategori-container-edit">
                        <li>
                            <div class="row mt-1">
                                <div class="col-md-6 mb-2">
                                    <div class="input-wrapper" id="due-kategori-edit">
                                        <input data-provide="datepicker" data-date-autoclose="true" type="text"
                                            id="edit-akhir" name="akhir_promo" class="col-lg-12">
                                        <label class="label-in">Akhir Promo</label>
                                    </div>
                                </div>
                                <div class="col-md-3 pr-0">
                                    <div class="input-wrapper" id="buy-edit" style="display: none;">
                                        <label for="buy-input" class="label-in">Buy</label>
                                        <input type="number" id="buy-input-edit" name="buy_input" class="col-lg-12"
                                            oninput="checkInput()">
                                    </div>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <div class="input-wrapper" id="free-edit" style="display: none;">
                                        <input type="number" id="free-input-edit" name="free_input" class="col-lg-12"
                                            oninput="checkInput()">
                                        <label class="label-in" for="free-input-edit">Free</label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-danger pl=0 pr=0 text-center" id="warning-edit"
                                    style="display: none;">
                                    <span style="font-size: 10px; font-weight: bold;">Promo kelipatan max
                                        buy= 5 & free= 3 </span>
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-ubah">
                        <span id="btn-text-ubah">Ubah</span>
                        <span id="loading-icon-ubah" class="loading" style="display:none;">
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
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal ubah -->

<!-- modal edit bundling-->
<div class="modal fade" id="ubah-bundling" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="ubah-bundling">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Tiket Bundling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-bundling">
                <div class="modal-body pb-1">
                    <input type="number" id="edit-id-price-bundle" class="col-lg-12" hidden>
                    <!-- <input type="text" id="id-event-bundle-edit" class="col-lg-12"> -->
                    <div class=" row mb-3">
                        <div class="col-md-6 mr-0 pr-0">
                            <div class="input-wrapper">
                                <input type="text" id="edit-nm-bundling" class="col-lg-12" required>
                                <label class="label-in">Nama Bundling</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="edit-harga-bundling" class="col-lg-12" required>
                                <label class="label-in">Harga Bundling</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-3 mr-0 pr-0">
                            <div class="input-wrapper">
                                <input type="number" id="edit-isi-bundle" class="col-lg-12" required
                                    oninput="hitungJumlahBundle()">
                                <label class="label-in">Isi Bundle</label>
                            </div>
                        </div>
                        <div class="col-md-3 mr-0 pr-0 ml-0 pl-0">
                            <div class="input-wrapper">
                                <input type="number" id="edit-jml-bundle" class="col-lg-12" required readonly>
                                <label class="label-in">Jml Bundle</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="number" id="edit-stock-bundle" class="col-lg-12" required readonly
                                    oninput="hitungJumlahBundle()">
                                <label class="label-in">Jml Isi Bundle</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 text-danger ml-0 mt-3" id="edit-warning" hidden fade-in
                            fade-out>
                            <span class="badge badge-danger" style="font-size: 9px; font-weight: bold;"> JML Bundle
                                harus bilangan bulat tidak boleh koma </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" id="btn-ubh-bundling">
                        <span id="btn-text-bundling-ubah">Simpan</span>
                        <span id="loading-icon-bundling-ubah" class="loading" style="display:none;">
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
            </form>
        </div>
    </div>
</div>
<!-- akhir edit bundling-->

<!-- modal bundling-->
<div class="modal fade" id="bundling" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Buat Tiket Bundling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="buat-bundling">
                <div class="modal-body">
                    <input type="number" id="id-price-bundle" class="col-lg-12" hidden>
                    <input type="text" value="<?= $this->uri->segment(3); ?>" id="id-event-bundle" class="col-lg-12"
                        hidden>
                    <div class=" row mb-3">
                        <div class="col-md-6 mr-0 pr-0">
                            <div class="input-wrapper">
                                <input type="text" id="nm-bundling" class="col-lg-12" required>
                                <label class="label-in">Nama Bundling</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="harga-bundling" class="col-lg-12" required>
                                <label class="label-in">Harga Bundling</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3 mt-1">
                        <div class="col-md-6 mb-2 mr-0 pr-0">
                            <div class="input-wrapper">
                                <label class="label-select2">Kategori Tiket</label>
                                <select class="select2 w-100" style="height:55px;" id="id-bundling" name="id_bundling"
                                    data-dropdown-parent="#bundling" required>
                                    <option value=''>-- Pilih Tiket --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mr-0 pr-0">
                            <div class="input-wrapper">
                                <input type="number" id="stok" class="col-lg-12" required disabled>
                                <label class="label-in">Stock</label>
                            </div>
                        </div>
                        <div class="col-md-3 ml-0 pl-0">
                            <div class="input-wrapper">
                                <input type="number" id="stok-tiket-reguler" class="col-lg-12" required disabled>
                                <label class="label-in">Sisa Tiket</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-3 mr-0 pr-0">
                            <div class="input-wrapper">
                                <input type="number" id="isi-bundle" class="col-lg-12" required>
                                <label class="label-in">Isi Bundle</label>
                            </div>
                        </div>
                        <div class="col-md-3 mr-0 pr-0 ml-0 pl-0">
                            <div class="input-wrapper">
                                <input type="number" id="jml-bundle" class="col-lg-12" required>
                                <label class="label-in">Jml Bundle</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="number" id="stock-bundle" class="col-lg-12" required readonly>
                                <label class="label-in">Jml Isi Bundle</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" id="btn-smpn-bundling">
                        <span id="btn-text-bundling">Simpan</span>
                        <span id="loading-icon-bundling" class="loading" style="display:none;">
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
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal bundling-->