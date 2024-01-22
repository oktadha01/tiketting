<section class="conteiner">
    <div class="row" style="justify-content: center;">
        <div class="card m-1" style="max-width:31rem">
            <div class="card-header">
                <center>
                    <h5 class="font-weight-bold">Complete payment</h5>
                </center>
            </div>
            <div class="card-body">
                <?php foreach ($transaksi as $data) { ?>
                    <center>
                        <h1 id="demo" style="font-family: fantasy; letter-spacing: 2px;"></h1>
                        <?php
                        $currentDateTime = date($data->tgl_transaksi);
                        $newDateTime = date('m-d-Y H:i:s', strtotime($currentDateTime . ' +1 hours'));

                        $dateString = $newDateTime;
                        $date = DateTime::createFromFormat('n-j-Y H:i:s', $dateString);

                        if ($date !== false) {
                            // Format tanggal sebagai bulan
                            $formattedDate = $date->format('M d, Y');

                            // Format jam
                            $formattedTime = $date->format('H:i:s');

                            // Output dengan pemisah antara tanggal dan jam
                            // echo $formattedDate . ' | ' . $formattedTime;
                        } else {
                            echo 'Format tanggal tidak valid';
                        }
                        ?>
                        <h6>Payment limit <?= $formattedDate . ' | ' . $formattedTime; ?></h6>
                        <input type="text" id="batas-waktu" value="<?= $newDateTime; ?>" hidden>
                    </center>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <span>Total Pembayaran</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right">Rp. <?= number_format($data->nominal, 0, ',', '.');?></span>
                        </div>
                    </div>
                    <?php
                    if ($data->tgl_transaksi >= date('d-m-Y H:i:s')) { ?>
                    <?php } else { ?>
                        <div class="row mt-2">
                            <div class="col-6">
                                <span>Virtual akun</span>
                            </div>
                            <div class="col-6">
                                <span class="float-right">3816529150853030</span>
                            </div>
                        </div>
                    <?php }
                    ?>

                <?php } ?>
            </div>
        </div>
    </div>
</section>