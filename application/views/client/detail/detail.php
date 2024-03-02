<style>
    .infomax {
        background: darkorange;
        font-weight: bold;
        padding: 1px 10px;
        border-radius: 6px;
        margin-top: 6px;
        display: flex;
    }

    /* .notif-email {
        right: 95px;
        position: relative;
        font-size: small;
        margin-bottom: 11px;
    } */

    .invalid-email,
    .invalid-email:focus {
        border: 2px solid #ff00008c;
        color: red;
    }

    .valid-email,
    .valid-email:focus {
        border: 2px solid #4CAF50;
        color: #4CAF50;
    }
</style>
<section class="container">
    <?php foreach ($event as $data) : ?>
        <center>
            <h3 class="f-s-tit-det font-weight-bold"><?= $data->agency; ?></h3>
            <p class="mb-0">Mempersembahkan : </p>
        </center>
    <?php endforeach; ?>
    <div class="row">
        <div class="col-lg-8 bar-none over-det-event">
            <div class="card p-body">
                <div class="card-body p-body">
                    <img src="<?= base_url('upload/event/') . $data->poster; ?>" style="border-radius: 15px;">
                    <h3 class="font-weight-bold mt-3"><?= $data->nm_event; ?></h3>
                    <div class="info-tgl-event-b">
                        <hr>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="padding-right: 15px;padding-left: 3px;"><i class="fa-regular fa-clock"></i> </td>
                                    <td> <?= $data->tgl_event; ?> | <?= $data->jam_event; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-right: 15px;padding-left: 4px;"><i class="fa-solid fa-location-dot"></i></td>
                                    <td><?= $data->lokasi; ?> | <?= $data->nama; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <span class="span-tit medium">Special Perfomence By :</span>
                    <?php foreach ($perform as $data) : ?>
                        <?php if ($data->status_perform == '1') { ?>
                            <h6 class="font-weight-bold"><?= $data->nama_artis; ?></h6>
                        <?php }  ?>
                    <?php endforeach; ?>

                    <span class="span-tit medium">Also Perfoming :</span>
                    <ul class="font-weight-bold" style="margin-left: 1rem;">
                        <?php foreach ($perform as $data) : ?>
                            <?php if ($data->status_perform == '2') { ?>
                                <li style="list-style: decimal;">
                                    <h6 class="font-weight-bold"><?= $data->nama_artis; ?></h6>
                                </li>
                            <?php } ?>
                        <?php endforeach; ?>
                    </ul>
                    <span class="span-tit medium">MC By : </span>
                    <h6 class="font-weight-bold"> <?= $data->mc_by; ?></h6>
                    <span class="span-tit medium">Description :</span>
                    <p class="desc-evnt"><?= $data->desc_event; ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div id="navi-tiket" class="nav-tiket nav right">
                <div class="info-tgl-event-t">
                    <div class="card mb-0">
                        <?php foreach ($event as $data) : ?>
                            <div class="card-body p-0 pl-3 pr-3">
                                <p class="mb-0"><?= $data->tgl_event; ?> | <?= $data->jam_event; ?></p>
                                <p class="mb-0"><?= $data->lokasi; ?> | <?= $data->nama; ?></p>
                                <!-- <p class="mb-0 font-weight-bold">Batas Pembelian : <?= $data->batas_pesan; ?></p> -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card mb-0">
                    <div class="card-header f-size-tik font-weight-bold">
                        <i class="fa-solid fa-arrow-left btn-close-tiket"></i> Pilih Tiket
                    </div>
                    <!-- <form action="<?= base_url('detail'); ?>/buynow" method="post"> -->
                    <div class="card-body bar-none max-h-list">
                        <ul>
                            <?php foreach ($tiket as $data) : ?>

                                <li class="border-cate-tiket box-shadow mt-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="small"><?= $data->kategori_price; ?></span><br>
                                            <input type="text" name="kategori_tiket[]" value="<?= $data->id_price; ?>" hidden>
                                            <span class="medium font-weight-bold">Rp.
                                                <?= number_format($data->harga, 0, ',', '.'); ?>,-</span>
                                        </div>
                                        <div class="col-6 pt-2">
                                            <?php if ($data->stock_tiket < $data->beli + $data->gratis + $data->tiket_bundling or $data->tgl_event > date("d/m/Y")) { ?>
                                                <button class="btn btn-dark float-right">Sold Out</button>
                                                <input hidden type="text" class="form-control input-count" name="count_tiket[]" placeholder="" aria-label="" aria-describedby="basic-addon1" value="0" readonly>
                                            <?php
                                            } else { ?>
                                                <button id="btn-add-tiket<?= $data->id_price; ?>" class="btn bg-w-blue text-light float-right btn-add-tiket plus" data-tiket="<?= $data->id_price; ?>" data-harga="<?= $data->harga; ?>">Add</button>
                                                <div id="count-tiket<?= $data->id_price; ?>" class="input-group mb-3" hidden>
                                                    <div class="input-group-prepend minus" data-harga="<?= $data->harga; ?>" data-tiket="<?= $data->id_price; ?>">
                                                        <i class="fa fa-minus btn btn-outline-secondary" style="padding-top: 11px; border: 1px solid #dce9f4;"></i>
                                                    </div>
                                                    <input type="text" class="form-control input-count" name="count_tiket[]" placeholder="" aria-label="" aria-describedby="basic-addon1" value="0" readonly>
                                                    <div class="input-group-prepend plus" data-harga="<?= $data->harga; ?>" data-status="<?= $data->status_bundling; ?>" data-tiket="<?= $data->id_price; ?>">
                                                        <i class="fa fa-plus btn btn-outline-secondary" style="padding-top: 11px; border: 1px solid #dce9f4;"></i>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="load-max-<?= $data->id_price; ?>" class="col">
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer card-footer-tiket-detail">
                        <div class="row">
                            <div class="col-6">

                                <span class="small">Subtotal </span><br>
                                <input id="in-subtotal" type="text" value="0" hidden>
                                <span id="subtotal" class="medium font-weight-bold">Rp. 0,-</span>
                            </div>
                            <div class="col-6 pt-2">
                                <?php if ($this->input->cookie('session') == '') { ?>
                                    <button id="checkout" class="btn bg-w-orange float-right btn-checkout" data-toggle="modal" data-target="#defaultModal" disabled>Checkout</button>
                                <?php
                                } else { ?>
                                    <button id="btn-submit" class="btn bg-w-orange float-right btn-checkout" disabled>Checkout</button>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container row btn-fixed-buy">
    <div class="col">
        <button class="col-12 btn bg-w-blue text-light box-shadow t-right">Beli Tiket</button>
    </div>
</div>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="label-login">Regitrasi email </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <span class="span-text-rest text-center"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-login">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" class="form-control" required="">
                                <span class="valid_info"></span>
                            </div>
                            <div id="form-pass" class="form-group">
                                <label>Password</label>
                                <input type="text" id="password" class="form-control" required="">
                                <span class="valid_pass"></span>
                            </div>
                            <div class="remember" hidden>
                                <input type="checkbox" id="remember" name="remember" value="" />
                                <label for="remember"> Remember</label>
                            </div>
                        </div>
                        <div class="form-rest-pass">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="" class="form-control email-rest" required="">
                                <span class="notif-email" style="border: none;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <span class="btn-lupa-pass float-right text-info">Lupa Password ?</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col p-0">
                    <button type="button" id="btn-close-modal" class="btn btn-danger " data-dismiss="modal">CLOSE</button>
                </div>
                <div class="col p-0">
                    <button type="button" id="btn-next" class="btn btn-primary float-right" disabled>Next</button>
                    <button type="button" id="btn-submit-rest-pass" class="btn btn-primary float-right">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- $('.modal-backdrop').removeClass('show') -->