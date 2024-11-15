<style>
.custom-btn-small {
    padding: 2px;
    font-size: 11px;
}
</style>


<link rel="stylesheet" href="<?= base_url('assets'); ?>/css/ribbons.css">

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
            <div class="navbar-right col-lg-6 col-md-6 col-sm-12 ">
                <form id="navbar-search" class="navbar-form search-form shadow" style="float: right;">
                    <input id="search-event" class="form-control" placeholder=" Search Event here..." type="text">
                    <button type="button" class="btn btn-default"> &nbsp; <i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="row clearfix" id="load_data">
    </div>
    <div id="load_data_message"></div>
</div>

<!-- modal tambah-->
<div class="modal fade" id="setting-fee" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="setting-fee">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Setting Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="internet-fee">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-0 pr-1">
                            <div class="input-wrapper">
                                <label class="label-select2">Event</label>
                                <select type="text" id="kategori" name="kategori" class="col-lg-12">
                                    <option value="">Pilih Kategori Fee</option>
                                    <option value="Default">Default</option>
                                    <option value="Custom">Custom</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="input-wrapper">
                                <input type="number" id="nominal" name="nominal" class="col-lg-12" required>
                                <label class="label-in">Nominal</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id-event" name="id_event" class="col-lg-12" required>
                </form>
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
        </div>
    </div>
</div>
<!-- akhir Modal tambah-->

<!-- modal ubah-->
<div class="modal fade" id="ubah-fee" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="setting-fee">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Internet Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubah-fee-form">
                    <!-- Ganti id menjadi ubah-fee-form -->
                    <div class="row mb-3">
                        <div class="col-md-6 mb-0 pr-1">
                            <div class="input-wrapper">
                                <label class="label-select2">Event</label>
                                <select type="text" id="edit-kategori" name="kategori" class="col-lg-12">
                                    <option value="">Pilih Kategori Fee</option>
                                    <option value="Default">Default</option>
                                    <option value="Custom">Custom</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="input-wrapper">
                                <input type="number" id="edit-nominal" name="nominal" class="col-lg-12" required>
                                <label class="label-in">Nominal</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id-fee" name="id_fee" class="col-lg-12" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btn-ubah" form="ubah-fee-form">
                    <!-- Tambahkan atribut form -->
                    <span id="btn-text-ubah">Ubah</span>
                    <span id="loading-icon-ubah" class="loading" style="display:none;">
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
        </div>
    </div>
</div>

<!-- akhir Modal ubah-->