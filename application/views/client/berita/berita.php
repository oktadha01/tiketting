<section class="container-artikel">
    <div class="text-center">
        <span class="font-size-tit font-weight-bold font-auto">Article</span>
    </div>
    <div class="row clearfix m-t-30">
        <div class="col-lg-3 col-md-4 col-sm-4 right-box d-none d-md-block">
            <div class="card mb-3">
                <div class="header">
                    <h2>Popular Posts</h2>
                </div>
                <div class="body widget popular-post pt-0">
                    <div class="row">
                        <div class="col-lg-12 mb-2 pl-1 pr-1" id="load_popular_post">
                            <div class="load_message_pop"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-8 left-box pl-2 pr-2 col-12" id="load_data">
            <div class="load_data_message"></div>
        </div>
        <div class="col-lg-3 col-md-12 right-box d-none d-md-block">
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach ($event_data_ready as $data) {
                        $event = preg_replace("![^a-z0-9]+!i", "-", $data->nm_event);
                        $hargaRP = 'Rp ' . number_format($data->min_price, 0, ',', '.') . ',-';
                    ?>
                    <div class="col-lg-12 col-md-6 col-12 pr-0 pl-0">
                        <?php
                            if (strtotime(str_replace('/', '-', date('d/m/Y'))) > strtotime(str_replace('/', '-', $data->tgl_event))) { ?>
                        <div class="card border-event min-h-artikel-event mb-1"
                            style="background: #cfcdcd; -webkit-filter: grayscale(100%); filter: grayscale(100%);">
                            <?php
                                } else { ?>
                            <div class="card border-event box-shadow">
                                <?php } ?>
                                <div class="card-body p-card pl-3 pr-3 pt-3 pb-0 mb-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-6">
                                            <div class="img-poster">
                                                <img src="<?= base_url('upload'); ?>/event/<?= $data->poster ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-6">
                                            <h5 class="font-size-post font-weight-bold mt-3">
                                                <?= $data->nm_event; ?></h5>
                                            <p class="font-size-det mb-1 small"><i class="fa fa-calendar"></i>
                                                <?= $data->tgl_event; ?> |
                                                <?= $data->jam_event; ?></p>
                                            <p class="font-size-det small"><i class="fa fa-map-marker"></i>
                                                <?= $data->lokasi; ?> |
                                                <?= $data->nama; ?></p>
                                            <div class="row" style=" align-items: center;">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <?php
                                                            if (strtotime(str_replace('/', '-', date('d/m/Y'))) > strtotime(str_replace('/', '-', $data->tgl_event))) { ?>
                                                    <span class="font-weight-bold" style="font-size: larger;">Sold
                                                        Out</span>
                                                    <?php
                                                        } else { ?>
                                                    <span class="small">Start Form</span><br>
                                                    <span class="medium font-weight-bold"><?= $hargaRP; ?>
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <?php
                                                            if (strtotime(str_replace('/', '-', date('d/m/Y'))) > strtotime(str_replace('/', '-', $data->tgl_event))) { ?>
                                                    <a class="bg-dark btn col-12 float-right text-light"
                                                        href="<?= site_url('detail/event/') . $event ?>">Berakhir</a>
                                                    <?php
                                                            } else { ?>
                                                    <a class="btn bg-w-orange float-right col-12"
                                                        href="<?= site_url('detail/event/') . $event ?>">Beli
                                                        Tiket</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 left-box m-0 p-0">
            <div class="card">
                <div class="body">
                    <ul class="row" id="data-more">
                    </ul>
                    <div class="message_berita_more mb-2"></div>
                    <div class="text-center mt-3 mb-1">
                        <div class="d-inline-block">
                            <button id="read-more-art" class="btn btn-xs btn btn-warning btn-custom "> <i
                                    class="fa fa-arrow-circle-o-down"></i> Read More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 right-box mt-1">
            <div class="card">
                <div class="header pb-0">
                    <h2>Tags</h2>
                </div>
                <div class="body widget mt-0">
                    <ul class="list-unstyled categories-clouds mb-0" id="data-tags">
                        <div class="load_message_tags"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>