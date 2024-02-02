<section class="conteiner mb-3">
    <div class="row mt-4 pt-4" style="justify-content: center;">
        <div class="card m-1 col-sm-8" style="max-width:26rem; background-image: url('assets/images/applove/approve.jpg'); background-size: cover; background-position: center;">
            <div class="card-header" style="background-color: #0047BA;">
                <h5 class="font-weight-bold text-center text-light">Complete payment</h5>
            </div>
            <div class="card-body">
                <?php foreach ($transaksi as $data) { ?>
                    <div class="text-center">
                        <h1 style="font-family: fantasy; letter-spacing: 2px;"></h1>
                        <h6>Payment Date : <?= $data->tgl_byr; ?> </h6>
                    </div>
                    <div class="text-center">
                        <div class="text-center">
                            <?php if ($data->status_transaksi == 0) : ?>
                                <h5 class="font-weight-bold" style="font-family: fantasy; letter-spacing: 4px; color: orange;">
                                    Pending
                                </h5>
                            <?php elseif ($data->status_transaksi == 1) : ?>
                                <h5 class="font-weight-bold" style="font-family: fantasy; letter-spacing: 2px; color: green;">
                                    Sukses
                                </h5>
                            <?php else : ?>
                                <?php if (empty($data->code_bayar)) : ?>
                                    <h5 class="font-weight-bold" style="font-family: fantasy; letter-spacing: 4px; color: red;">
                                        Tidak ada invoice / Expired
                                    </h5>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                   
                    <hr style="color: green;">
                    <div class="row mt-1">
                        <div class="col-6">
                            <span>Code Pembayaran </span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?= $data->code_bayar; ?> </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span>Nama Customer </span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?= $data->nm_customer; ?> </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span>Bank</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?= $data->bank; ?> </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span>Total Pembayaran</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right">Rp. <?= number_format($data->nominal, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                    <div class="row pl-0 ml-0">
                        <div class="col-lg-6 col-md-6 col-12 mt-4 mb-1 ml-0 pl-0">
                            <a class="btn bg-w-orange text-end" href="<?= site_url('Home') ?>">Kembali</a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-4 mb-1 text-right">
                            <?php if ($data->status_transaksi == 0) : ?>
                                <a class="btn bg-w-blue text-light payNowButton" data-url-payment="<?= $data->url_payment; ?>">Pay Now</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>