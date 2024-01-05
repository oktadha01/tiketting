<section class="container">
    <?php foreach ($event as $data) : ?>
        <center>
            <h3 class="font-weight-bold"><?= $data->agency; ?></h3>
            <p>Mempersembahkan : </p>
        </center>
    <?php endforeach; ?>
    <div class="row">
        <div class="col-lg-8 bar-none" style="height: 35rem;overflow: overlay;">
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url('assets'); ?>/images/poster.png" style="border-radius: 15px;">
                    <h3 class="font-weight-bold mt-3"><?= $data->nm_event; ?></h3>

                    <span class="medium">Special Perfomence By :</span>
                    <?php foreach ($perform as $data) : ?>
                        <?php if ($data->status_perform == 'special') { ?>
                            <h6 class="font-weight-bold"><?= $data->nama_artis; ?></h6>
                        <?php }  ?>
                    <?php endforeach; ?>

                    <span class="medium">Also Perfoming :</span>
                    <ul class="font-weight-bold" style="margin-left: 1rem;">
                        <?php foreach ($perform as $data) : ?>
                            <?php if ($data->status_perform == 'also') { ?>
                                <li style="list-style: decimal;">
                                    <h6 class="font-weight-bold"><?= $data->nama_artis; ?></h6>
                                </li>
                            <?php } ?>
                        <?php endforeach; ?>
                    </ul>
                    <span class="medium">MC By : </span>
                    <h6 class="font-weight-bold"> <?= $data->mc_by; ?></h6>
                    <span class="medium">Description :</span>
                    <p><?= $data->desc_event; ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <?php foreach ($event as $data) : ?>
                    <div class="card-body">
                        <p class="mb-1"><?= $data->tgl_event; ?> | <?= $data->jam_event; ?></p>
                        <p class="mb-1"><?= $data->lokasi; ?> | <?= $data->kota; ?></p>
                        <p class="mb-1 font-weight-bold">Batas Pembelian : <?= $data->batas_pesan; ?></p>

                    </div>
                <?php endforeach; ?>
            </div>
            <div class="card">
                <div class="card-header font-weight-bold">
                    Pilih Tiket
                </div>
                <!-- <form action="<?= base_url('detail'); ?>/buynow" method="post"> -->
                <div class="card-body bar-none" style="height: 18rem; overflow: overlay;">
                    <ul>
                        <?php foreach ($tiket as $data) : ?>
                            <li class="border-cate-tiket mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="small"><?= $data->kategori_price; ?></span><br>
                                        <input type="text" name="kategori_tiket[]" value="<?= $data->id_price; ?>" hidden>
                                        <span class="medium font-weight-bold">Rp. <?= number_format($data->harga, 0, ',', '.'); ?>,-</span>
                                    </div>
                                    <div class="col-6 pt-2">
                                        <button id="btn-add-tiket<?= $data->id_price; ?>" class="btn btn-primary float-right btn-add-tiket plus" data-tiket="<?= $data->id_price; ?>" data-harga="<?= $data->harga; ?>">Add</button>
                                        <div id="count-tiket<?= $data->id_price; ?>" class="input-group mb-3" hidden>
                                            <div class="input-group-prepend minus" data-harga="<?= $data->harga; ?>">
                                                <i class="fa fa-minus btn btn-outline-secondary" style="padding-top: 11px; border: 1px solid #dce9f4;"></i>
                                            </div>
                                            <input type="text" id="input-tiket-<?= $data->id_price; ?>" class="form-control input-count" name="count_tiket[]" placeholder="" aria-label="" aria-describedby="basic-addon1" value="0" readonly>
                                            <div class="input-group-prepend plus" data-harga="<?= $data->harga; ?>">
                                                <i class="fa fa-plus btn btn-outline-secondary" style="padding-top: 11px; border: 1px solid #dce9f4;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">

                            <span class="small">Subtotal </span><br>
                            <input id="in-subtotal" type="text" value="0" hidden>
                            <span id="subtotal" class="medium font-weight-bold">Rp. 0,-</span>
                        </div>
                        <div class="col-6 pt-2">
                            <?php if ($this->input->cookie('session') == '') { ?>
                                <button id="checkout" class="btn btn-info float-right btn-checkout" data-toggle="modal" data-target="#defaultModal" disabled>Checkout</button>
                            <?php
                            } else { ?>
                                <button id="btn-sumbmit" class="btn btn-info float-right btn-checkout" disabled>Checkout</button>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</section>
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
                        <div class="remember">
                            <input type="checkbox" id="remember" name="remember" value="" />
                            <label for="remember"> Remember</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-sumbmit" class="btn btn-primary">Next</button>
                <button type="button" id="btn-close-modal" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!-- $('.modal-backdrop').removeClass('show') -->