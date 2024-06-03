<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= site_url('Prices/list_price/' . $this->uri->segment(3)); ?>"><i
                                class="fa fa-list-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><?= $bread?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix row-deck">
        <div class="col-lg-4 col-md-4 pr-0">
            <div class="card profile-header">
                <form id="simpan-warna" enctype="multipart/form-data" method="post">
                    <div class="body mt-0 pt-0">
                        <div class="media">
                            <div class="media-body text-start">
                                <small class="text-danger">Disarankan Ukuran 2481px x 1751px</small>
                                </p>
                                <button type="button" class="btn btn-outline-warning" id="btn-upload-photo">Upload
                                    Backround</button>
                                <input type="file" id="filePhoto" name="filePhoto" class="sr-only">
                            </div>
                        </div>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <b for="color-picker">Warna Nama</b>
                                <div class="input-group colorpicker">
                                    <input type="text" class="form-control nama-color" id="color-nama">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><span class="input-group-addon"> <i></i>
                                            </span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <b>Warna Email</b>
                                <div class="input-group colorpicker">
                                    <input type="text" class="form-control email-color" id="color-email">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><span class="input-group-addon"> <i></i>
                                            </span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <b>Warna Kategori</b>
                                <div class="input-group colorpicker">
                                    <input type="text" class="form-control kategori-color" id="color-kategori">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><span class="input-group-addon"> <i></i>
                                            </span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <b>Warna Kode Tiket</b>
                                <div class="input-group colorpicker">
                                    <input type="text" class="form-control kode-color" id="color-kode">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><span class="input-group-addon"> <i></i>
                                            </span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control mb-2" id="id-event" value="<?= $this->uri->segment(3);?>"
                        hidden>
                    <div class="col-lg-12 col-md-12 align-right mr-2 mt-0 mb-2">
                        <button type="submit" class="btn btn-primary" id="btn-simpan">
                            <span id="btn-text">Simpan</span>
                            <span id="loading-icon" class="loading" style="display:none;">
                                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="3" />
                                    <g>
                                        <circle cx="4" cy="12" r="3" />
                                        <circle cx="20" cy="12" r="3" />
                                        <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                            dur="1s" keySplines=".36,.6,.31,1;.36,.6,.31,1"
                                            values="0 12 12;180 12 12;360 12 12" repeatCount="indefinite" />
                                    </g>
                                </svg> Loading...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="media-center position-relative" id="preview">
                    <div class="logo">
                        <img src="<?= base_url('upload/backround_tiket/logo.png') ?>">
                    </div>

                    <?php if (!empty($kustomisasi)): ?>
                    <?php foreach ($kustomisasi as $data): ?>
                    <img src="<?= base_url('upload/backround_tiket/' . ($data->id_event !== null ? $data->background : 'default_upload.png')) ?>"
                        id="previewImage" class="img-fluid img-thumbnail" alt="Background">
                    <?php endforeach; ?>
                    <?php else: ?>
                    <img src="<?= base_url('upload/backround_tiket/default_upload.png') ?>" id="previewImage"
                        class="img-fluid img-thumbnail" alt="Background">
                    <?php endif; ?>

                    <div class="overlay-text-container">
                        <h4 class="mb-0 nama">WISDIL</h4>
                        <p class="mb-0 email">tiket@wisdil.com</p>
                        <h5 class="kategori">VVIP</h5>
                    </div>
                    <div class="qrcode">
                        <img src="<?= base_url('upload/backround_tiket/qrcode.png') ?>" class="img-fluid img-thumbnail">
                    </div>
                    <div class="kode-tiket">
                        <p class="mb-0 kod">Kode Tiket</p>
                        <h6 class="kod-tik">CT-53520221-0002</h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>