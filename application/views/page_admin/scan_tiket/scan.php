<link rel="stylesheet" href="<?= base_url('assets'); ?>/css/ribbons.css">
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Scan_tiket'); ?>"> <i
                                class="fa fa-ticket"></i></a></li>
                    <li class="breadcrumb-item active"><?= $bread?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-xl-3 col-lg-3 col-md-2">
        </div>
        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">
            <div class="card member-card">
                <div class="header primary-bg pt-1">
                    <h4 class="mt-1 text-light">Klik Logo QR </h4>
                    <h6 class="mt-1 text-light">Untuk Scan Tiket </h6>
                </div>
                <div class="member-img">
                    <a><img src="assets/images/QR_menu/qrcode-logo.png" data-toggle="modal" class="rounded-circle"
                            data-target="#scan-tiket" alt="profile-image"></a>
                </div>
                <div class="body mb-0 pb-0">
                    <hr>
                    <div class="chat">
                        <div class="chat-history row p-0 m-0">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 pl-0 pr-0 pb-2">
                                <img src="<?= base_url('assets'); ?>/images/icon/biru.png" width="110" height="95"
                                    style="z-index: 1; position: absolute; top: 18%; left: 50%; transform: translate(-50%, -50%); padding: 20px;">
                                <h5 class="mb-0 text-light"
                                    style="width: 100%; height: 50%; position: relative; z-index: 2;">
                                    <?= $total_tiket?>
                                </h5>
                                <p class="pt-1"><span><b>Tiket Terjual</b></span></p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 pl-0 pr-0 pb-2">
                                <img src="<?= base_url('assets'); ?>/images/icon/hijau.png" width="110" height="95"
                                    style="z-index: 1; position: absolute; top: 18%; left: 50%; transform: translate(-50%, -50%); padding: 20px;">
                                <h5 class="mb-0 text-light"
                                    style="width: 100%; height: 50%; position: relative; z-index: 2;">
                                    <?= $tiket_diambil?></h5>
                                <p class="pt-1"> <span><b>Sudah diambil </b> </span></p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 pl-0 pr-0 pb-2">
                                <img src="<?= base_url('assets'); ?>/images/icon/merah.png" width="110" height="95"
                                    style="z-index: 1; position: absolute; top: 18%; left: 50%; transform: translate(-50%, -50%); padding: 20px;">
                                <h5 class=" mb-0 text-light"
                                    style="width: 100%; height: 50%; position: relative; z-index: 2;"><?= $tiket_belum?>
                                </h5>
                                <p class="pt-1"><span><b>Belum diambil</b></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-2">
        </div>
    </div>
</div>

<!-- modal Scan-->
<div class="modal fade" id="scan-tiket" tabindex="-1" role="dialog" aria-labelledby="scan-QR" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form id="scan">
                <div class="modal-body mt-0 pt-0">
                    <div class="row">
                        <div class="col-lg-12 col-md-7 col-sm-12 mb-0 pb-0">
                            <div class="card top_widget mb-0 pb-0">
                                <div class="body m-0 p-0">
                                    <div id="result" class="result-mob">
                                    </div>
                                    <div id="reader" style="width: 100%; height: 50%; position: relative; z-index: 1;">
                                    </div>
                                    <div
                                        class="input-group mb-3 mt-1 col-md-5 col-lg-5 col-sm-12 pr-0 pl-0 mr-0 ml-0 mx-auto">
                                        <input type="text" class="form-control rounded-2" id="manualCodeInput"
                                            placeholder="Input Manual" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary fa fa-search-plus"
                                                onclick="submitManualCode(event)"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal Scan-->