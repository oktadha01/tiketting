<section class="">

    <div class="swiper slider1 container-fluid" style=" padding: 0px 5px;">

        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?= base_url('upload'); ?>/1.jpg" class="slide-item" alt="">
            </div>
            <div class="swiper-slide">
                <img src="<?= base_url('upload'); ?>/2.jpg" class="slide-item" alt="">
            </div>
            <div class="swiper-slide">
                <img src="<?= base_url('upload'); ?>/3.jpg" class="slide-item" alt="">
            </div>
            <div class="swiper-slide">
                <img src="<?= base_url('upload'); ?>/5.jpg" class="slide-item" alt="">
            </div>
            <div class="swiper-slide">
                <img src="<?= base_url('upload'); ?>/6.jpg" class="slide-item" alt="">
            </div>
            <div class="swiper-slide">
                <img src="<?= base_url('upload'); ?>/7.jpg" class="slide-item" alt="">
            </div>
        </div>

        <div class="swiper-pagination"></div>

    </div>
</section>
<section class="container space-content-kategori">
    <span class="font-size-tit font-weight-bold">Pilihan Kategori Event</span>
    <div class="row" style="place-content: center;justify-content: space-around;">
        <div class="col-lg-2 col-md-2 col-6 kategori-event box-shadow p-1 mt-2 ">
            <img class="img-fluid" src="<?= base_url('assets'); ?>/images/seminar.png" alt="">
        </div>
        <div class="col-lg-2 col-md-2 col-6 kategori-event box-shadow p-1 mt-2">
            <img class="img-fluid" src="<?= base_url('assets'); ?>/images/pameran.png" alt="">
        </div>
        <div class="col-lg-2 col-md-2 col-4 kategori-event box-shadow p-1 mt-2">
            <img class="img-fluid" src="<?= base_url('assets'); ?>/images/pertunjukan.png" alt="" style="width: inherit;">
        </div>
        <div class="col-lg-2 col-md-2 col-4 kategori-event box-shadow p-1 mt-2">
            <img class="img-fluid" src="<?= base_url('assets'); ?>/images/musik.png" alt="">
        </div>
        <div class="col-lg-2 col-md-2 col-4 kategori-event box-shadow p-1 mt-2">
            <img class="img-fluid" src="<?= base_url('assets'); ?>/images/all-events.png" alt="">
        </div>
    </div>
</section>
<section class="container space-content-event">
    <span class="font-size-tit font-weight-bold">Rekomendasi Event</span>
    <div class="row">
        <?php for ($x = 1; $x <= 3; $x++) { ?>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="card box-shadow">
                    <div class="row card-body p-card">
                        <div class="col-lg-12 col-md-12 col-6">

                            <div class="img-poster">
                                <img src="<?= base_url('assets'); ?>/images/poster.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-6">
                            <h5 class="font-size-post font-weight-bold mt-3">Wisma Music Festival (Vol. 01)</h5>
                            <p class="font-size-det mb-1 small"><i class="fa fa-calendar"></i> 01/12/2023 | 19:00</p>
                            <p class="font-size-det small"><i class="fa fa-map-marker"></i> Alun - alun kab. Semaranng | Semarang</p>
                            <div class="row" style=" align-items: center;">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <span class="small">Start Form</span><br>
                                    <span class="medium font-weight-bold">Rp.100.000,-</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <button class="btn bg-w-orange float-right col-12">Beli Tiket</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</section>
<section class="container">
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
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.</p>
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
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.</p>
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
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.</p>
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
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus optio facilis beatae.</p>
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
</section>