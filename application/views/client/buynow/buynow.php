<style>
    .th,
    .td {
        padding-left: 25px;
    }

    .span-no {
        background: #fecd0a;
        padding: 4px 11px;
        border-radius: 6px;
        font-weight: bold;
        color: #0047ba;
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

    .mt-5rem {
        margin-top: 5rem;
    }
</style>
<section class="container mt-4">
    <div class="mt-5rem">
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
    </div>
    <div class="card box-shadow">
        <div class="card-body p-1" style="    background: #00000008;">
            <div class="row">
                <div class="col-lg-1 col-md-2 col-3">
                    <img src="<?= base_url('assets'); ?>/images/poster.png" alt="" class="img-fluid" style="width: 5rem;border-radius: 6px;">
                </div>
                <div class="col-lg-10 col-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">

                            <?php foreach ($event as $data) : ?>
                                <h6 class="font-weight-bold"><?= $data->nm_event; ?></h6>
                                <p class="small mb-0"><i class="fa fa-calendar"></i> <?= $data->tgl_event; ?> |
                                    <?= $data->jam_event; ?></p>
                                <p class="small "><i class="fa fa-map-marker"></i> <?= $data->lokasi; ?> |
                                    <?= $data->nama; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h6 class="font-weight-bold">Tiket</h6>
                            <?php
                            $arr_kategori = array_map('trim', explode(",", $data_kategori));
                            $arr_count = array_map('trim', explode(",", $data_count));
                            foreach (array_combine($arr_kategori, $arr_count) as $kategori => $count) {
                                if ($count > '0') {
                                    $tiket = "(SELECT * FROM price WHERE id_price = $kategori)";
                                    $query = $this->db->query($tiket);
                                    foreach ($query->result() as $rows) {
                            ?>

                                        <p class="small mb-0"><i class="fa fa-ticket"></i> <?= $rows->kategori_price; ?> x<?= $count; ?></p>
                            <?php
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($action) == '') {
        $action = 'open';
    } else {
        // $action == 'open';
    }
    if ($action == 'open') { ?>
        <form id="myForm" action="<?= base_url('Buynow/checkout'); ?>" method="POST">
            <?php foreach ($customer as $data) { ?>
                <input type="text" name="akun" value="<?= $data->id_customer; ?>" hidden>
            <?php
            } ?>
            <?php foreach ($event as $data) : ?>

                <input type="text" name="id_event" value="<?= $data->id_event; ?>">
            <?php endforeach; ?>
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
                                                        <label>Email<sup class="text-danger">*</sup></label>
                                                        <input type="text" name="email[]" id="email" required class="form-control email-<?= $no; ?>" value="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Nama<sup class="text-danger">*</sup></label>
                                                        <input type="text" name="nama[]" required class="form-control nama-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Tgl lahir<sup class="text-danger">*</sup></label>
                                                        <input type="text" name="tgl_lahir[]" required class="form-control tgl-lahir tgl-lahir-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>gender<sup class="text-danger">*</sup></label>
                                                        <br>
                                                        <label class="fancy-radio">
                                                            <input type="radio" id="gender-male-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="male">
                                                            <span><i></i>Pria</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" id="gender-female-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="female">
                                                            <span><i></i>Wanita</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                        <input type="text" name="gender[]" id="gender-<?= $no; ?>" value="" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>No. Whatsapp<sup class="text-danger">*</sup></label>
                                                        <input type="text" name="kontak[]" id="kontak" required class="form-control kontak-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="label-nik">NIK/Paspor<sup class="text-danger">*</sup></label>
                                                        <input type="text" name="no_identitas[]" id="no-identitas" required class="form-control no-identitas-<?= $no; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="input-wrapper">
                                                        <label class="label-select2">Kota<sup class="text-danger">*</sup></label>
                                                        <select class="select2 form-control select-kota kota-<?= $no; ?>" name="kota[]" required>
                                                            <option value=''>-- Pilih Kota --</option>
                                                        </select>
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
                                        <!-- <span>Tiket Gratis <?= $rows->kategori_price; ?></span> -->
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
                                                            <label>Email<sup class="text-danger">*</sup></label>
                                                            <input type="text" name="email[]" id="email" required class="form-control email-<?= $no; ?>" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Nama<sup class="text-danger">*</sup></label>
                                                            <input type="text" name="nama[]" required class="form-control nama-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Tgl lahir<sup class="text-danger">*</sup></label>
                                                            <input type="text" name="tgl_lahir[]" required class="form-control tgl-lahir tgl-lahir-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>gender<sup class="text-danger">*</sup></label>
                                                            <br>
                                                            <label class="fancy-radio">
                                                                <input type="radio" id="gender-male-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="male">
                                                                <span><i></i>Pria</span>
                                                            </label>
                                                            <label class="fancy-radio">
                                                                <input type="radio" id="gender-female-<?= $no; ?>" class="gender gender-<?= $no; ?>" data-no="<?= $no; ?>" value="female">
                                                                <span><i></i>Wanita</span>
                                                            </label>
                                                            <p id="error-radio"></p>
                                                            <input type="text" name="gender[]" id="gender-<?= $no; ?>" value="" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>No. Whatsapp<sup class="text-danger">*</sup></label>
                                                            <input type="text" name="kontak[]" id="kontak" required class="form-control kontak-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="label-nik">NIK/Paspor<sup class="text-danger">*</sup></label>
                                                            <input type="text" name="no_identitas[]" id="no-identitas" required class="form-control no-identitas-<?= $no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-wrapper">
                                                            <label class="label-select2">Kota<sup class="text-danger">*</sup></label>
                                                            <select class="select2 form-control select-kota kota-<?= $no; ?>" name="kota[]" required>
                                                                <option value=''>-- Pilih Kota --</option>
                                                            </select>
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
                                if ($rows->harga == '0') {
                                    $total = '0';
                                    $fee = '0';
                                } else {
                                    $total = $rows->harga * $count + $total;
                                    $fee = $total * 0.03 + 7850;
                                }

                    ?>

                                <div class="row bg-white">
                                    <div class="col-6">
                                        <span class="medium font-weight-bold"><?= $rows->kategori_price; ?></span><br>
                                        <?php if ($fee == '0') { ?>

                                        <?php } else { ?>
                                            <span class="small ">
                                                Rp. <?= number_format($rows->harga, 0, ',', '.'); ?>
                                                x<?= $count; ?>

                                                <?php
                                                if ($rows->status_bundling == '0' and $count >= $rows->beli and $rows->gratis > '0') { ?>
                                                    <sup> Free x<?= $rows->gratis; ?></sup>
                                                <?php } ?>
                                            </span>
                                        <?php } ?>

                                    </div>
                                    <div class="col-6">
                                        <?php if ($fee == '0') { ?>
                                            <span class="medium font-weight-bold float-right"><?= $count; ?> x</span><br>
                                        <?php } else { ?>
                                            <span class="medium font-weight-bold float-right">Rp.
                                                <?= number_format($rows->harga * $count, 0, ',', '.'); ?></span><br>
                                        <?php } ?>

                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                    <?php if ($fee == '0') { ?>

                    <?php } else { ?>
                        <div class="row bg-white">
                            <div class="col-6">
                                <span class="medium font-weight-bold">Total Tiket</span>
                            </div>
                            <div class="col-6">
                                <span class="medium font-weight-bold float-right">Rp. <?= number_format($total, 0, ',', '.'); ?></span>
                            </div>
                        </div>
                        <div class="row bg-white">
                            <div class="col-6">
                                <span class="medium font-weight-bold">Internet fee</span>
                            </div>
                            <div class="col-6">
                                <span class="medium font-weight-bold float-right">Rp. <?= number_format($fee, 0, ',', '.'); ?></span>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row bg-white">
                        <div class="col-6">
                            <span class="medium font-weight-bold">Total Pembayaran</span>
                        </div>
                        <div class="col-6">
                            <?php if ($fee == '0') { ?>
                                <span class="medium font-weight-bold float-right">Free</span>
                            <?php } else { ?>
                                <span class="medium font-weight-bold float-right">Rp. <?= number_format($total + $fee, 0, ',', '.'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col"> -->
                        <?php foreach ($customer as $data) { ?>
                            <?php if ($data->password == '') { ?>
                                <button id="btn-submit-login" type="button" class="col-12 btn bg-w-orange" onclick="submitWithLoading('btn-submit-login')">
                                    <span id="btn-text-login">Bayar</span>
                                    <span id="btn-loading-login" class="loading" style="display:none;">
                                        <i class="fas fa-spinner fa-spin"></i> Loading...
                                    </span>
                                </button>
                            <?php } else { ?>
                                <button id="btn-submit" class="col-12 btn bg-w-orange" onclick="submitWithLoading('btn-submit')">
                                    <span id="btn-text">Bayar</span>
                                    <span id="btn-loading" class="loading" style="display:none;">
                                        <i class="fas fa-spinner fa-spin"></i> Loading...
                                    </span>
                                </button>
                            <?php } ?>
                        <?php
                        } ?>
                        <!-- </div> -->
                    </div>
                </div>
            </div>

            <?php if ($this->input->cookie('session') == '') { ?>
                <div class="modal fade" id="modal-insert-pass" tabindex="-1" role="dialog">
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
                                            <input type="email" id="email-login" name="email-login" class="form-control">
                                            <span class="valid_info"></span>

                                        </div>
                                        <div id="form-pass" class="form-group">
                                            <label>Password</label>
                                            <input type="text" id="password-login" name="password-login" class="form-control">
                                            <span class="text-invalid-pass text-danger"></span>
                                        </div>
                                        <div class="remember" hidden>
                                            <input type="checkbox" id="remember" name="remember" value="" checked="true">
                                            <label for="remember"> Remember</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col" style="text-align-last: center;display: grid;">
                                        <span class="notif-call-log bg-w-blue text-light" style="border-radius: 3px;">Password
                                            akun berhasil dibuat</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btn-close-modal" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                                <button type="submit" id="submit" class="btn btn-info">Oke</button>
                                <button type="button" id="btn-login" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </form>
    <?php } else { ?>
        <div class="row">
            <div class="col">
                <a href="<?= base_url('Detail/event'); ?>/<?= preg_replace("![^a-z0-9]+!i", "-", $data->nm_event); ?>">
                    <button class="btn bg-w-orange col-12">Pesan tiket lainnya</button>
                </a>
            </div>
        </div>
    <?php
    } ?>
</section>
<!-- no delete trigger-->
<button class="btn show-modal-pass" data-toggle="modal" data-target="#modal-insert-pass"></button>
<!-- <form id="myFormm">
    <input type="text" name="test[]" required class="form-control">
    <input type="text" name="test[]" required class="form-control">
    <input type="text" name="test[]" required class="form-control">
    <button type="" class="submit">Submit</button>
</form> -->