<link rel="stylesheet" href="<?= base_url('assets'); ?>/css/ribbons.css">
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Sales_tiket'); ?>"><i
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