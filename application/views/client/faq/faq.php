<style>
    @charset "UTF-8";

    /*** START BS OVERRIDES ***/
    .features {
        padding: 50px 0;
    }

    .features.light-brown {
        background-color: #faf8f5;
    }

    .features h2.section-title {
        color: #333333;
        font-size: 22px;
        margin: 0;
        text-align: center;
    }

    .features .v-tabs .v-tab-head a,
    .features .v-tabs a.v-tab-head {
        color: #292929;
        cursor: pointer;
        display: block;
        padding: 15px 30px 15px 15px;
        border-right: 1px solid #33cc66;
        margin: 0;
        text-align: right;
        font: 20px "Raleway", "franklin-gothic-urw", "Helvectica Neue", helvetica, clean, sans-serif;
    }

    .features .v-tabs .v-tab-head a.tab-active,
    .features .v-tabs .v-tab-head a:hover,
    .features .v-tabs a.v-tab-head.tab-active,
    .features .v-tabs a.v-tab-head:hover {
        font-weight: bold;
        text-decoration: none;
    }

    .features .v-tabs .v-tab-head a {
        position: relative;
        display: block;
    }

    .features .v-tabs .v-tab-head a.tab-active::after,
    .features .v-tabs .v-tab-head a.tab-active::before {
        content: "";
        border-style: solid;
        border-width: 15px;
        position: absolute;
        right: 0;
        top: 15px;
        transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
    }

    .features .v-tabs .v-tab-head a.tab-active::before {
        border-color: #3fcf6e transparent transparent;
    }

    .features .v-tabs .v-tab-head a.tab-active::after {
        margin-right: -1px;
        border-color: #faf8f5 transparent transparent;
    }

    .features .v-tabs a.v-tab-head {
        border: none;
        padding: 15px 0;
        text-align: left;
        position: relative;
    }

    .features .v-tabs a.v-tab-head:after {
        color: #e2dcd6;
        content: "";
        font-family: FontAwesome;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -o-transform: translateY(-50%);
    }

    .features .v-tabs a.v-tab-head.tab-active::after {
        color: #3c6;
        content: "";
    }

    .features .v-tabs .v-tab-pane {
        padding: 0 15px;
    }

    .features .v-tabs .v-tab-pane ul {
        list-style: outside none none;
        margin: 0;
        padding: 0;
    }

    .features .v-tabs .v-tab-pane ul li {
        border-bottom: 1px solid #e2dcd6;
        color: #292929;
        font-size: 16px;
        padding: 15px 0;
    }

    .features .v-tabs .v-tab-pane ul li i {
        color: #4c81b6;
        cursor: pointer;
        font-size: 14px;
    }

    .features .v-tabs .v-tab-pane .in {
        border-top: none;
        padding-top: 0;
    }

    .features .v-tabs .v-tab-pane .popover {
        border: 1px solid #014d7e !important;
        border-radius: 0;
        width: auto;
        margin: 10px 0 0 0;
        max-width: 276px;
        left: auto;
        box-shadow: none;
    }

    .features .v-tabs .v-tab-pane .popover.bottom .arrow {
        border-bottom-color: #014d7e;
    }

    .features .v-tabs .v-tab-pane .popover .popover-content {
        font-size: 14px;
        padding: 15px;
        text-align: center;
    }

    @media screen and (max-width: 768px) {
        .features.light-brown {
            border-top: 0 none;
        }

        .features h2.section-title {
            font-size: 32px;
        }

        .features .v-tabs .v-tab-pane .in {
            border-top: 1px solid #DDD;
            border-bottom: 2px solid #DDD;
        }

        .features .popover {
            margin: 10px 5% 0;
            max-width: none;
            width: 90%;
        }
    }

    ol li {
        list-style-type: auto;
        margin-bottom: 9px;
    }

    h4 {
        font-weight: bold !important;
    }

    .container {
        min-width: 90%;
    }

    .siz-log-pay {
        width: 7rem !important;
    }

    .navbar:before,
    .navbar:after {
        display: none !important;
    }
</style>

<div class="light-brown features mt-5" id="features">
    <section class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="section-title hidden-xs text-center mb-5 mt-5">Frequently Asked Question</h2>
                <h2 class="section-title visible-xs text-center mb-5 mt-5">Frequently Asked Question</h2>
            </div>
        </div>
        <div class="row v-tabs">
            <div class="col-sm-4 v-tab-head hidden-xs">
                <a class="v-tab-link active" data-target="#coreFeatures-tab">Cara Pembelian Tiket Wisdil</a>
                <a class="v-tab-link" data-target="#designingBuildingTools-tab">Informasi "Email Succes"</a>
                <a class="v-tab-link" data-target="#hostingUtilitiesSettings-tab">Informasi pembatalan tiket yang sudah di bayarkan / di beli</a>
                <a class="v-tab-link" data-target="#marketing-tab">Batas waktu pembayaran tiket</a>
                <a class="v-tab-link" data-target="#email-tab">Cara Penukaran e-tiket Wisdil</a>
                <a class="v-tab-link" data-target="#ecommerce-tab"> Informasi metode pembayaran tiket</a>
                <a class="v-tab-link" data-target="#technology-tab">Informasi harga tiket event</a>
            </div>
            <div class="col-sm-8 v-tab-pane">
                <a class="v-tab-head v-tab-link visible-xs tab-active" data-target="#coreFeatures-tab">Cara Pembelian Tiket Wisdil</a>
                <div id="coreFeatures-tab" class="collapse fade in">
                    <ol>
                        <li>Pembeli memilih tiket event yang diinginkan, silahkan mengunjungi website artatix.co.id</li>
                        <li>Pilih event atau klik searching box dan tulis event yang ingin dibeli </li>
                        <li>Kemudian pilih tiket yang ingin dibeli</li>
                        <li>Selanjutnya mengisi data diri dan pastikan benar</li>
                        <li>Klik “Lanjutkan” dan pilih metode pembayaran yang diinginkan</li>
                        <li>Silahkan melakukan pembayaran sebelum batas waktu pembayaran selesai</li>
                        <li>Cek secara berkala di email inbox ataupun whatsapp untuk melihat e-tiket kamu</li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#designingBuildingTools-tab">Informasi "Email Succes"</a>
                <div id="designingBuildingTools-tab" class="collapse fade">
                    <p>Email success merupakan email pemesanan tiket event di Artatix yang berhasil dibayarkan dan akan digunakan sebagai tanda bukti pembelian tiket event.</p>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#hostingUtilitiesSettings-tab">Informasi pembatalan tiket yang sudah di bayarkan / di beli</a>
                <div id="hostingUtilitiesSettings-tab" class="collapse fade">
                    <p>Tiket yang sudah dibeli tidak bisa untuk dibatalkan atau direfund. Pastikan pembelian tiket event sudah sesuai dengan yang diinginkan</p>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#marketing-tab">Batas waktu pembayaran tiket</a>
                <div id="marketing-tab" class="collapse fade">
                    <p>Untuk batas waktu pembayaran maks. 3 jam. Jika melebihi jangka waktu tersebut, maka pesanan akan otomatis dibatalkan dan silahkan melakukan pemesanan ulang</p>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#email-tab">Cara Penukaran e-tiket Wisdil</a>
                <div id="email-tab" class="collapse fade">
                    <p>Untuk informasi jadwal penukaran e-tiket dapat langsung mengunjungi official akun instagram penyelenggara event. Pada saat penukaran tiket diharap menunjukkan:</p>
                    <ol>
                        <li>E-tiket asli</li>
                        <li>Identitas (Sesuai dengan e-tiket)</li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#ecommerce-tab">Informasi metode pembayaran tiket</a>
                <div id="ecommerce-tab" class="collapse fade">
                    <p><strong>1. Bank Transfer: </strong></p>
                    <ul>
                        <li>BNI, BRI, Mandiri, Permata, BSI, BJB &amp; BCA</li>
                    </ul>
                    <p><strong>2. E-wallet: </strong></p>
                    <ul>
                        <li>Dana, Ovo, LinkAja &amp; Astrapay</li>
                    </ul>
                    <p><strong>3. QRIS: </strong></p>
                    <ul>
                        <li>OVO, Shopee pay, Gopay, Linkaja, Dana, BCA dan lainnya</li>
                    </ul>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#technology-tab">Informasi harga tiket event</a>
                <div id="technology-tab" class="collapse fade">
                    <p>Untuk harga tiket dan detail mengenai event yang ingin dibeli, dapat langsung mengunjungi website artatix.co.id</p>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">