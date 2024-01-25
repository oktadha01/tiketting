<style>
    .infomax {
        background: darkorange;
        font-weight: bold;
        padding: 1px 10px;
        border-radius: 6px;
        margin-top: 6px;
        display: flex;
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
                    <img src="<?= base_url('assets'); ?>/images/poster.png" style="border-radius: 15px;">
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
                                    <td><?= $data->lokasi; ?> | <?= $data->kota; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <span class="span-tit medium">Special Perfomence By :</span>
                    <?php foreach ($perform as $data) : ?>
                        <?php if ($data->status_perform == 'special') { ?>
                            <h6 class="font-weight-bold"><?= $data->nama_artis; ?></h6>
                        <?php }  ?>
                    <?php endforeach; ?>

                    <span class="span-tit medium">Also Perfoming :</span>
                    <ul class="font-weight-bold" style="margin-left: 1rem;">
                        <?php foreach ($perform as $data) : ?>
                            <?php if ($data->status_perform == 'also') { ?>
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
            <div class="info-tgl-event-t">
                <div class="card">
                    <?php foreach ($event as $data) : ?>
                        <div class="card-body">
                            <p class="mb-1"><?= $data->tgl_event; ?> | <?= $data->jam_event; ?></p>
                            <p class="mb-1"><?= $data->lokasi; ?> | <?= $data->kota; ?></p>
                            <p class="mb-1 font-weight-bold">Batas Pembelian : <?= $data->batas_pesan; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="nav-tiket nav right">
                <div class="card mb-0">
                    <div class="card-header f-size-tik font-weight-bold">
                        <i class="fa-solid fa-arrow-left btn-close-tiket"></i> Pilih Tiket
                    </div>
                    <!-- <form action="<?= base_url('detail'); ?>/buynow" method="post"> -->
                    <div class="card-body bar-none" style="height: 18rem; overflow: overlay;">
                        <ul>
                            <?php foreach ($tiket as $data) : ?>
                                <li class="border-cate-tiket box-shadow mt-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="small"><?= $data->kategori_price; ?></span><br>
                                            <input type="text" name="kategori_tiket[]" value="<?= $data->id_price; ?>" hidden>
                                            <span class="medium font-weight-bold">Rp. <?= number_format($data->harga, 0, ',', '.'); ?>,-</span>
                                        </div>
                                        <div class="col-6 pt-2">
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
                    <!-- </form> -->
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
                <h4 class="title" id="defaultModalLabel">Regitrasi email </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-next" class="btn btn-primary" disabled >Next</button>
                <button type="button" id="btn-close-modal" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<!-- $('.modal-backdrop').removeClass('show') -->