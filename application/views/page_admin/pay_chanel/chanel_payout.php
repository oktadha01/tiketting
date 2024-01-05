<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Dashboard'); ?>"><i
                                class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item active"><?= $tittle?></li>
                </ul>
            </div>
        </div>
    </div>
    <h2>Creat VA</h2>
    <div class="modal-body">
        <form action="<?php echo base_url('Dashboard/virtual_account') ?>" method="POST">
            <div class=" row mb-2">
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="input-wrapper">
                        <label class="label-select2">No. Invoice</label>
                        <input type="text" id="external_id" name="ext_id" class="col-lg-12" required>
                    </div>
                </div>
            </div>
            <div class=" row mb-3">
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="input-wrapper">
                        <label class="label-select2">Bank</label>
                        <select class="select2 w-100" style="height:55px;" id="bank_code" name="bank_code">
                            <option value=""> Pilih Bank </option>
                            <option value="BCA"> BCA VA </option>
                            <option value="BNI"> BNI VA </option>
                            <option value="MANDIRI"> MANDIRI VA </option>
                            <option value="BRI"> BRI VA </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class=" row mb-3">
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="input-wrapper">
                        <label class="label-select2">Nama VA</label>
                        <select class="select2 w-100" style="height:55px;" id="name_va" name="name_va">
                            <option value="Pembeyaran Tiket"> Pembayaran Tiket </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer col-lg-4 col-md-6">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
        </form>
    </div>
</div>