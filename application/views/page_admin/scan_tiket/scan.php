<link rel="stylesheet" href="<?= base_url('assets'); ?>/css/ribbons.css">
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Scan_tiket'); ?>"><i
                                class="fa fa-ticket"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><?= $bread?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 ">
                    <div class="card top_widget">
                        <div class="body mb-1 pb-1">
                            <div id="reader"></div>
                            <div class="input-group mb-3 mt-1 col-md-5 col-lg-5 col-sm-12 pr-0 pl-0 mr-0 ml-0 mx-auto">
                                <input type="text" class="form-control rounded-2" id="manualCodeInput"
                                    placeholder="Input Manual" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary fa fa-search-plus"
                                        onclick="submitManualCode()"></button>
                                </div>
                            </div>
                        </div>
                        <div class="sparkline col-sm-12" data-type="line" data-spot-Radius="4" data-offset="90"
                            data-width="100%" data-height="100px" data-line-Width="1" data-line-Color="#73cec7"
                            data-fill-Color="#73cec7">
                            2,3,1,5,4,2,3,1,5,4,7,8,2,3,1,4,6,5,4,4,4,7,8,2,3,1,4,6,5,4
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 text-center">
                    <div id="result" class="mt-4">
                        <div>
                            <h4 style="padding-top: 80px">Scan Result </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>