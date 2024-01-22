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
                        <div class="col-md-3 mb-2 pr-2 pl-2 mr-0 pr-0">
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
                                        <input type="number" id="buy-input" class="col-lg-12">
                                        <label class="label-in">Buy</label>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <div class="input-wrapper" id="free" style="display: none;">
                                        <input type="number" id="free-input" class="col-lg-12">
                                        <label class="label-in">Free</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="number" id="edit-stock-tiket" class="col-lg-12" required>
                                <label class="label-in">Stock Tiket</label>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <label class="fancy-checkbox ml-1 mt-2">
                                <input type="checkbox" name="checkbox" id="edit-status" onchange="perbaruiStatusedit()">
                                <span>Promo</span>
                            </label>
                        </div>
                        <div class="col-md-6 mb-2" id="due-kategori-edit" style="display: none;">
                            <div class="input-wrapper">
                                <input data-provide="datepicker" data-date-autoclose="true" type="text" id="edit-akhir"
                                    name="akhir_promo" class="col-lg-12">
                                <label class="label-in">Akhir Promo</label>
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

<!-- modal edit bundling-->
<div class="modal fade" id="ubah-bundling" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
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
                    <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal bundling-->

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
                    <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal bundling-->

<!-- modal edit bundling-->
<div class="modal fade" id="ubah-bundling" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
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
                    <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal bundling-->