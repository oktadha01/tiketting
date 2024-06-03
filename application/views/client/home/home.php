<section class="">
    <div class="swiper slider1 container-fluid" style=" padding: 0px 5px;">
        <div class="swiper-wrapper">
            <?php foreach ($banner as $data) { ?>
            <div class="swiper-slide">
                <img src="<?= base_url('upload'); ?>/banner/<?= $data->header ?>" class="slide-item" alt="">
            </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>

</section>

<section class="container space-content-kategori">
    <span class="font-size-tit font-weight-bold">Pilihan Kategori Event</span>
    <div class="cont-slider">

        <div class="row" style="display: flex;">
            <div class="kategori-event p-0 mt-2">
                <img class="img-fluid" src="<?= base_url('assets'); ?>/images/kat_menu/pameran.png" alt="">
            </div>
            <div class="kategori-event p-0 mt-2">
                <img class="img-fluid" src="<?= base_url('assets'); ?>/images/kat_menu/musik.png" alt="">
            </div>
            <div class="kategori-event p-0 mt-2 ">
                <img class="img-fluid" src="<?= base_url('assets'); ?>/images/kat_menu/seminar.png" alt="">
            </div>
            <div class="kategori-event p-0 mt-2">
                <img class="img-fluid" src="<?= base_url('assets'); ?>/images/kat_menu/pertunjukan.png" alt=""
                    style="width: inherit;">
            </div>
            <div class="kategori-event p-0 mt-2">
                <img class="img-fluid" src="<?= base_url('assets'); ?>/images/kat_menu/wisata.png" alt="">
            </div>
            <div class="kategori-event p-0 mt-2">
                <img class="img-fluid" src="<?= base_url('assets'); ?>/images/kat_menu/all-events.png" alt="">
            </div>
        </div>
    </div>
</section>
<section class="container space-content-event">
    <span class="font-size-tit font-weight-bold">Rekomendasi Event</span>
    <div class="row">
        <?php foreach ($event_data_ready as $data) {
            $event = preg_replace("![^a-z0-9]+!i", "-", $data->nm_event);
            $hargaRP = 'Rp ' . number_format($data->min_price, 0, ',', '.') . ',-';
            // echo date("d/m/Y");
        ?>
        <div class="col-lg-4 col-md-6 col-12">

            <?php

                // Memeriksa apakah tanggal saat ini lebih besar dari tanggal target
                if (strtotime(str_replace('/', '-', date('d/m/Y'))) > strtotime(str_replace('/', '-', $data->tgl_event))) { ?>
            <div class="card border-event min-h-reko-event"
                style="background: #cfcdcd; -webkit-filter: grayscale(100%); filter: grayscale(100%);">
                <?php
                } else { ?>
                <div class="card border-event box-shadow">
                    <?php } ?>
                    <div class="card-body p-card">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-6">
                                <div class="img-poster">
                                    <img src="<?= base_url('upload'); ?>/event/<?= $data->poster ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-6">
                                <h5 class="font-size-post font-weight-bold mt-3"><?= $data->nm_event; ?></h5>
                                <p class="font-size-det mb-1 small"><i class="fa fa-calendar"></i>
                                    <?= $data->tgl_event; ?> |
                                    <?= $data->jam_event; ?></p>
                                <p class="font-size-det small"><i class="fa fa-map-marker"></i> <?= $data->lokasi; ?> |
                                    <?= $data->nama; ?></p>
                                <div class="row" style=" align-items: center;">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <?php
                                            // Memeriksa apakah tanggal saat ini lebih besar dari tanggal target
                                            if (strtotime(str_replace('/', '-', date('d/m/Y'))) > strtotime(str_replace('/', '-', $data->tgl_event))) { ?>
                                        <span class="font-weight-bold" style="font-size: larger;">Sold Out</span>
                                        <?php
                                            } else { ?>
                                        <span class="small">Start Form</span><br>
                                        <span class="medium font-weight-bold"><?= $hargaRP; ?> </span>
                                        <?php } ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <?php
                                            // Memeriksa apakah tanggal saat ini lebih besar dari tanggal target
                                            if (strtotime(str_replace('/', '-', date('d/m/Y'))) > strtotime(str_replace('/', '-', $data->tgl_event))) { ?>
                                        <a class="bg-dark btn col-12 float-right text-light"
                                            href="<?= site_url('detail/event/') . $event ?>">Berakhir</a>
                                        <?php
                                            } else { ?>
                                        <a class="btn bg-w-orange float-right col-12"
                                            href="<?= site_url('detail/event/') . $event ?>">Beli Tiket</a>
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
        <hr>
</section>


<!-- <section class="container res-height">
    <span class="font-size-tit font-weight-bold">Apa Kata Mereka</span>
    <div class="testimonial-slider">
        <div class="testimonial-slide">
            <div class="testimonial_box">
                <div class="testimonial_box-inner">
                    <div class="testimonial_box-top box-shadow">
                        <div class="testimonial_box-icon">
                            <i class="i-con fas fa-quote-right"></i>
                        </div>
                        <div class="testimonial_box-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.
                            </p>
                        </div>
                        <div class="testimonial_box-shape"></div>
                    </div>
                    <div class="testimonial_box-bottom">
                        <div class="testimonial_box-profile">
                            <div class="testimonial_box-img">
                                <img class="img-box" src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                            </div>
                            <div class="testimonial_box-info">
                                <div class="testimonial_box-name">
                                    <h4>John Doe</h4>
                                </div>
                                <div class="testimonial_box-job">
                                    <p>WISDIL.COM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-slide">
            <div class="testimonial_box">
                <div class="testimonial_box-inner">
                    <div class="testimonial_box-top box-shadow">
                        <div class="testimonial_box-icon">
                            <i class="i-con fas fa-quote-right"></i>
                        </div>
                        <div class="testimonial_box-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.
                            </p>
                        </div>
                        <div class="testimonial_box-shape"></div>
                    </div>
                    <div class="testimonial_box-bottom">
                        <div class="testimonial_box-profile">
                            <div class="testimonial_box-img">
                                <img class="img-box" src="https://i.ibb.co/JQ18QKW/asd.jpg" alt="profile">
                            </div>
                            <div class="testimonial_box-info">
                                <div class="testimonial_box-name">
                                    <h4>John Doe</h4>
                                </div>
                                <div class="testimonial_box-job">
                                    <p>WISDIL.COM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-slide">
            <div class="testimonial_box">
                <div class="testimonial_box-inner">
                    <div class="testimonial_box-top box-shadow">
                        <div class="testimonial_box-icon">
                            <i class="i-con fas fa-quote-right"></i>
                        </div>
                        <div class="testimonial_box-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.
                            </p>
                        </div>
                        <div class="testimonial_box-shape"></div>
                    </div>
                    <div class="testimonial_box-bottom">
                        <div class="testimonial_box-profile">
                            <div class="testimonial_box-img">
                                <img class="img-box" src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                            </div>
                            <div class="testimonial_box-info">
                                <div class="testimonial_box-name">
                                    <h4>John Doe</h4>
                                </div>
                                <div class="testimonial_box-job">
                                    <p>WISDIL.COM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-slide">
            <div class="testimonial_box">
                <div class="testimonial_box-inner">
                    <div class="testimonial_box-top box-shadow">
                        <div class="testimonial_box-icon">
                            <i class="i-con fas fa-quote-right"></i>
                        </div>
                        <div class="testimonial_box-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.
                            </p>
                        </div>
                        <div class="testimonial_box-shape"></div>
                    </div>
                    <div class="testimonial_box-bottom">
                        <div class="testimonial_box-profile">
                            <div class="testimonial_box-img">
                                <img class="img-box" src="https://i.ibb.co/JQ18QKW/asd.jpg" alt="profile">
                            </div>
                            <div class="testimonial_box-info">
                                <div class="testimonial_box-name">
                                    <h4>John Doe</h4>
                                </div>
                                <div class="testimonial_box-job">
                                    <p>WISDIL.COM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- News -->
<section class="container mt-4">
    <span class="font-size-tit font-weight-bold font-auto">News</span>
    <div class="row m-t-30 m-b-20" id="load_data">
    </div>
    <div id="load_data_message"></div>
    <div class="align-center">
        <a href="<?= base_url('Berita'); ?>" class=" btn btn-warning btn-custom"><i
                class="fa fa-pied-piper-alt text-light"></i> &nbsp;Berita
            Lainnya</a>
    </div>
</section>
<!-- Akhir News -->