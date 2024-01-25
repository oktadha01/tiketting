<style>
    th,
    td {
        padding-left: 25px;
    }

    .span-no {
        background: cadetblue;
        padding: 4px 11px;
        border-radius: 6px;
        font-weight: bold;
        color: white;
    }

    .sup-no {
        background: bisque;
        padding: 0px 5px;
        border-radius: 5px;
        font-weight: bold;
    }

    hr {
        border-bottom: 1px solid;
    }

    .card-info-tiket {
        background: orange;
        color: white;
        border-radius: 5px;
    }

    .card-info-tiket-sold {
        background: orangered;
        color: white;
        border-radius: 5px;
    }
</style>
<section class="container mt-4">
    <?php
    if (isset($data_kategori_sold)) {
        $arr_kategori_sold = array_map('trim', explode(",", $data_kategori_sold));
        $arr_count_sold = array_map('trim', explode(",", $data_count_sold));
        foreach (array_combine($arr_kategori_sold, $arr_count_sold) as $kategori_sold => $count_sold) {
            if ($count_sold >= '0') {

                $tiket = "(SELECT * FROM price WHERE id_price = $kategori_sold)";
                $query = $this->db->query($tiket);
                foreach ($query->result() as $rows) {
    ?>
                    <?php
                    if ($rows->stock_tiket == '0') { ?>
                        <div class="card box-shadow card-info-tiket-sold mb-1">
                            <div class="card-body" style="padding: 4px 10px;">
                                <span><span class="medium font-weight-bold">Sorry !</span> <span>Ticket : <span class="font-weight-bold"><?= $rows->kategori_price; ?></span> ready stock ticket <span class="font-weight-bold"> Sold Out</span></span></span>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card box-shadow card-info-tiket mb-1">
                            <div class="card-body" style="padding: 4px 10px;">
                                <span><span class="medium font-weight-bold">Sorry !</span> <span>Ticket : <span class="font-weight-bold"><?= $rows->kategori_price; ?></span> ready stock ticket <span class="font-weight-bold"> <?= $rows->stock_tiket - $rows->gratis; ?> x</span></span></span>
                            </div>
                        </div>
                    <?php
                    } ?>
    <?php
                }
            }
        }
    } else {
    }
    ?>
    <div class="card box-shadow">
        <div class="card-body p-1" style="    background: #00000008;">
            <ul class="mb-0" style="display: flex;">
                <li>
                    <img src="<?= base_url('assets'); ?>/images/poster.png" alt="" class="img-fluid" style="width: 5rem;border-radius: 6px;">
                </li>
                <li>
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($event as $data) : ?>

                                    <th><?= $data->nm_event; ?></th>
                                <?php endforeach; ?>
                                <th>Tiket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php foreach ($event as $data) : ?>
                                        <p class="small mb-0"><i class="fa fa-calendar"></i> <?= $data->tgl_event; ?> | <?= $data->jam_event; ?></p>
                                        <p class="small mb-0"><i class="fa fa-map-marker"></i> <?= $data->lokasi; ?> | <?= $data->kota; ?></p>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php
                                    $arr_kategori = array_map('trim', explode(",", $data_kategori));
                                    $arr_count = array_map('trim', explode(",", $data_count));
                                    foreach (array_combine($arr_kategori, $arr_count) as $kategori => $count) {
                                        if ($count > '0') {
                                            $tiket = "(SELECT * FROM price WHERE id_price = $kategori)";
                                            $query = $this->db->query($tiket);
                                            foreach ($query->result() as $rows) {
                                    ?>

                                                <p class="small mb-0"><i class="fa fa-ticket"></i><?= $rows->kategori_price; ?> x<?= $count; ?></p>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>
    </div>
    <form action="<?= base_url('Buynow/checkout'); ?>" method="POST">
        <?php foreach ($customer as $data) { ?>
            <input type="text" name="akun" value="<?= $data->id_customer; ?>" hidden>
        <?php
        } ?>
        <?php foreach ($event as $data) : ?>

            <input type="text" name="id_event" value="<?= $data->id_event; ?>" hidden>
        <?php endforeach; ?>
        <?php
        if ($data_kategori >= '0') { ?>
            <div class="card box-shadow">
                <div class="card-header bg-w-blue text-light">
                    <h4 class="font-weight-bold">Tiket User</h4>
                </div>
                <div class="card-body p-1">
                    <?php
                    $arr_kategori = array_map('trim', explode(",", $data_kategori));
                    $arr_count = array_map('trim', explode(",", $data_count));
                    $span_no = 1;
                    $no = 1;
                    foreach (array_combine($arr_kategori, $arr_count) as $kategori => $count) {
                        if ($count > '0') {
                            $tiket = "(SELECT * FROM price WHERE id_price = $kategori)";
                            $query = $this->db->query($tiket);
                            foreach ($query->result() as $rows) {

                                for ($x = 1; $x <= $count; $x++) {

                                    // echo "Ticket: $rows->kategori_price, Count: $count\n <br>";
                    ?>
                                    <div class="card mb-0">
                                        <div class="card-header p-2">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="span-no"><?= $span_no++; ?></span>
                                                    <span><?= $rows->kategori_price; ?> <sup class="sup-no"><?= $x; ?></sup></span>
                                                    <input type="text" name="id_price[]" value="<?= $rows->id_price; ?>" hidden>
                                                    <input type="text" name="code[]" value="<?= $x; ?>" hidden>
                                                    <input type="text" name="status[]" value="" hidden>
                                                </div>
                                                <?php if ($no++ == 1) { ?>
                                                    <div class="col">
                                                        <span>Registrasi Data</span>
                                                    </div>
                                                <?php
                                                } else { ?>
                                                    <div class="col">
                                                        <label class="fancy-checkbox float-right">
                                                            <input type="checkbox" name="checkbox" class="ceklis-same-regis" data-parsley-multiple="checkbox" value="<?= $no; ?>">
                                                            <span>Same as registration data</span>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="email[]" id="email" required="" class="form-control email-<?= $no; ?>" value="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" name="nama[]" id="nama" required="" class="form-control nama-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Tgl lahir</label>
                                                        <input type="text" name="tgl_lahir[]" id="tgl-lahir" required="" class="form-control tgl-lahir-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>gender</label>
                                                        <br>
                                                        <label class="fancy-radio">
                                                            <input type="radio" id="gender-male-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="male">
                                                            <span><i></i>Male</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" id="gender-female-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="female">
                                                            <span><i></i>Female</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                        <input type="text" name="gender[]" id="gender-<?= $no; ?>" value="" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>No Wa</label>
                                                        <input type="text" name="kontak[]" id="kontak" required="" class="form-control kontak-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>No identita</label>
                                                        <input type="text" name="no_identitas[]" id="no-identitas" required="" class="form-control no-identitas-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Kota / kabupaten</label>
                                                        <input type="text" name="kota[]" id="kota" required="" class="form-control kota-<?= $no; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                if ($count >= $rows->beli and $rows->gratis > '0') {
                                    for ($x = 1; $x <= $rows->gratis; $x++) {
                                    ?>
                                        <span>Tiket Gratis <?= $rows->kategori_price; ?></span>
                                        <div class="card mb-0">
                                            <div class="card-header p-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="span-no"><?= $span_no++; ?></span>
                                                        <span><?= $rows->kategori_price; ?> <sup class="sup-no"><?= $x; ?></sup> <sup class="sup-no">Free Ticket</sup></span>
                                                        <input type="text" name="id_price[]" value="<?= $rows->id_price; ?>" hidden>
                                                        <input type="text" name="code[]" value="<?= $x; ?>" hidden>
                                                        <input type="text" name="status[]" value="free" hidden>
                                                    </div>
                                                    <?php if ($no++ == 1) { ?>
                                                        <div class="col">
                                                            <span>Registrasi Data</span>
                                                        </div>
                                                    <?php
                                                    } else { ?>
                                                        <div class="col">
                                                            <label class="fancy-checkbox float-right">
                                                                <input type="checkbox" name="checkbox" class="ceklis-same-regis" data-parsley-multiple="checkbox" value="<?= $no; ?>">
                                                                <span>Same as registration data</span>
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" name="email[]" id="email" required="" class="form-control email-<?= $no; ?>" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" name="nama[]" id="nama" required="" class="form-control nama-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Tgl lahir</label>
                                                            <input type="text" name="tgl_lahir[]" id="tgl-lahir" required="" class="form-control tgl-lahir-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>gender</label>
                                                            <br>
                                                            <label class="fancy-radio">
                                                                <input type="radio" id="gender-male-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="male">
                                                                <span><i></i>Male</span>
                                                            </label>
                                                            <label class="fancy-radio">
                                                                <input type="radio" id="gender-female-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="female">
                                                                <span><i></i>Female</span>
                                                            </label>
                                                            <p id="error-radio"></p>
                                                            <input type="text" name="gender[]" id="gender-<?= $no; ?>" value="" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>No Wa</label>
                                                            <input type="text" name="kontak[]" id="kontak" required="" class="form-control kontak-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>No identita</label>
                                                            <input type="text" name="no_identitas[]" id="no-identitas" required="" class="form-control no-identitas-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Kota / kabupaten</label>
                                                            <input type="text" name="kota[]" id="kota" required="" class="form-control kota-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    <?php
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="card box-shadow">
                <div class="card-header bg-w-blue text-light">
                    <h4 class="font-weight-bold">Detail Pembayaran</h4>
                </div>
                <div class="card-body pt-2 pb-2" style="background: #80808012;">
                    <?php
                    $arr_kategori = array_map('trim', explode(",", $data_kategori));

                    $arr_count = array_map('trim', explode(",", $data_count));
                    $total = 0;
                    foreach (array_combine($arr_kategori, $arr_count) as $kategori => $count) {
                        if ($count > '0') {
                            $tiket = "(SELECT * FROM price WHERE id_price = $kategori)";
                            $query = $this->db->query($tiket);
                            foreach ($query->result() as $rows) {
                                $total = $rows->harga * $count + $total;

                    ?>

                                <div class="row bg-white">
                                    <div class="col-6">
                                        <span class="medium font-weight-bold"><?= $rows->kategori_price; ?></span><br>
                                        <span class="small ">
                                            Rp. <?= number_format($rows->harga, 0, ',', '.'); ?>
                                            x<?= $count; ?>

                                            <?php
                                            if ($rows->status_bundling == '0' and $count >= $rows->beli and $rows->gratis > '0') { ?>
                                                <sup> Free x<?= $rows->gratis; ?></sup>
                                            <?php } ?>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="medium font-weight-bold float-right">Rp. <?= number_format($rows->harga * $count, 0, ',', '.'); ?></span><br>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                    <div class="row bg-white">
                        <div class="col-6">
                            <h4 class="font-weight-bold">Total Pembayaran</h4>
                        </div>
                        <div class="col-6">
                            <h4 class="font-weight-bold float-right">Rp. <?= number_format($total, 0, ',', '.'); ?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col"> -->
                        <?php if ($this->input->cookie('session') == '') { ?>
                            <button type="button" id="btn-submit-login" class="col-12 btn bg-w-orange">Bayar</button>
                        <?php
                        } else { ?>
                        <?php
                        } ?>
                        <button type="" id="btn-submit" class="col-12 btn bg-w-orange">Bayar</button>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        <?php } else {
        } ?>
        <?php if ($this->input->cookie('session') == '') { ?>
            <div class="modal fade" id="modal-pass" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Password</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group" hidden>
                                        <label>Email</label>
                                        <input type="email" id="email-login" name="email-login" class="form-control" required="">
                                        <span class="valid_info"></span>

                                    </div>
                                    <div id="form-pass" class="form-group">
                                        <label>Password</label>
                                        <input type="text" id="password-login" name="password-login" class="form-control" required="">
                                    </div>
                                    <div class="remember" hidden>
                                        <input type="checkbox" id="remember" name="remember" value="" checked="true">
                                        <label for="remember"> Remember</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="text-align-last: center;display: grid;">
                                    <span class="notif-call-log bg-w-blue text-light" style="border-radius: 3px;">Passwod akun berhail di tambahkan</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="" id="submit" class="btn btn-primary">Oke</button>
                            <button type="button" id="btn-login" class="btn btn-primary">Next</button>
                            <button type="button" id="btn-close-modal" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </form>
</section>
<!-- no delete trigger-->
<button class="btn show-modal-pass" data-toggle="modal" data-target="#modal-pass"></button>