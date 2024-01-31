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
                <h2 class="section-title hidden-xs text-center">Syarat Dan Ketentuan</h2>
                <h2 class="section-title visible-xs text-center">Syarat Dan Ketentuan</h2>
            </div>
        </div>
        <div class="row v-tabs">
            <div class="col-sm-4 v-tab-head hidden-xs">
                <a class="v-tab-link active" data-target="#coreFeatures-tab">Definisi & Interpretasi</a>
                <a class="v-tab-link" data-target="#designingBuildingTools-tab">Ketentuan Umum</a>
                <a class="v-tab-link" data-target="#hostingUtilitiesSettings-tab">Tipe Penggolongan Klien Kami</a>
                <a class="v-tab-link" data-target="#marketing-tab">Informasi Pribadi</a>
                <a class="v-tab-link" data-target="#email-tab">Cookies & Hak Cipta</a>
                <a class="v-tab-link" data-target="#ecommerce-tab"> kebijakan Pengembalian Uang</a>
                <a class="v-tab-link" data-target="#technology-tab">Pembelaan & Domisili Hukum</a>
            </div>
            <div class="col-sm-8 v-tab-pane">
                <a class="v-tab-head v-tab-link visible-xs tab-active" data-target="#coreFeatures-tab">Definisi & Interpretasi</a>
                <div id="coreFeatures-tab" class="collapse fade in">
                    <ol>
                        <li>Seluruh persetujuan “Konsumen”, ”Kamu”, dan “Anda” menggantikan kamu, yaitu orang atau badan hukum yang mengakses website ini.</li>
                        <li>Menyetujui syarat dan ketentuan perusahaan “WISDIL”,”Penyedia Layanan”, dan “Kami” sebagai perusahaan kami (WISDIL).</li>
                        <li>“Member”, ”Event Creator”, ”Panitia”, dan “Mereka” menggantikan klien kami yang menggunakan system kami untuk membuat dan menjual tiket acara/event mereka.</li>
                        <li>“Pembeli” berarti setiap individu dan/atau badan hukum yang membeli dengan harga tertentu atau secara cuma-cuma tiket yang diselenggarakan oleh Event Creator
                            secara sah dan sesuai dengan ketentuan penggunaan ini, syarat dan ketentuan yang berlaku pada tempat Event, syarat dan ketentuan yang ditetapkan oleh Event Creator,
                            serta peraturan perundang-undangan yang berlaku.</li>
                        <li>“Situs” berarti WISDIL.co.id yang dikelola dan dimiliki oleh WISDIL.</li>
                        <li>“Event” berarti sesuatu kegiatan yang bersifat komersial maupun tidak komersial yang diselenggarakan oleh Event Creator yang menggunakan jasa layanan
                            Platform kami untuk menunjang kegiatan acara tersebut.</li>
                        <li>“WISDIL.com” berarti adalah layanan yang kami sediakan untuk kamu Event Creator berupa penyediaan platform
                            untuk menunjang Event yang memberikan kemudahan dengan penggunaan teknologi untuk Event Creator guna membuat,
                            memasarkan, menjual, dan/atau mendistribusikan event secara mandiri, dimana layanan tersebut dapat berubah dari waktu ke waktu berdasarkan kebijakan kami sendiri.</li>
                        <li>“Biaya Jasa” berarti biaya jasa sebagai imbalan kepada kami atas jasa atau produk layanan kami, termasuk namun
                            tidak terbatas pada penyediaan Platform guna menunjang Event kamu, baik berupa uang, presentase maupun jasa yang dapat
                            dinilai, yang kami tetapkan dari waktu ke waktu berdasarkan kebijakan kami sendiri.</li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#designingBuildingTools-tab">Ketentuan Umum</a>
                <div id="designingBuildingTools-tab" class="collapse fade">
                    <ol>
                        <li> Jika terjadi konflik atau inkonsistensi antara dua atau lebih ketentuan antara kami dan pengguna, maka penyedia layanan yang memutuskan ketentuan mana yang akan digunakan. </li>
                        <li> Kesepakatan ini berlaku ketika kamu dan event creator menggunakan system kami (menjual tiket, membuat event, menyunting event, mengunduh data, menyunting data, dan membeli tiket). </li>
                        <li> Selain ketentuan penggunaan ini dan tergantung pada layanan yang dipilih oleh kamu. Kamu wajib untuk membaca dan menerima aturan dan ketentuan layanan tersebut yang mungkin akan berlaku untuk layanan tersebut. </li>
                        <li> WISDIL akan mengumumkan setiap perubahan melalui Platform. Event Creator diwajibkan untuk membaca dengan baik setiap perubahan tersbut sehingga apabila event creator tetap mengunakan, mengakses atau memanfaatkan Platform dianggap telah mengetahui, memahami dan menyetujui perubahan tersebut. </li>
                        <li> Seluruh pemesanan tiket oleh pembeli pada cara yang dibuat oleh event manager memiliki ketentuan dan persetujuan yang terpisah dengan ketentuan ini. Kami hanya penyedia layanan yang membantu memaksimalkan acara event creator, yang mana seluruh penjualan merupakan properti event creator. Kami tidak bertanggun jawab dan kamu setuju membebaskan kami dari seluruh tuntutan jika terjadi perselisihan, penuntutan hak, permintaan kompensasi kematian akibat menghadiri acara dan seluruh hak langsung dan tidak langsung yang disebabkan oleh event creator. </li>
                        <li> Untuk menghindari keragu-raguan, event creator telah memahami dan menyetujui bahwa WISDIL tidak memberikan jaminan dalam bentuk apapun atas keberhasilan penyelenggara Event baik dalam bentuk hasil penjualan tiket maupun kelancaran pelakasanaan event. Event creator dengan ini membebaskan dan melepaskan WISDIL dan menanggung dari segala bentuk tuntutan, gugatan, permintaan, kerugian, klaim, dan/atau segala bentuk penggantian hak oleh pihak manapun termasuk Event Creator sendiri yang timbul akibat dari termasuk namun tidak terbatas pada hasil penjualan tiket dan penyelenggaraan event. </li>
                        <li> Kami menghimbau pembeli untuk tidak menyebarluaskan e-Tiket miliknya kepada siapapun dan dimanapun. </li>
                        <li> Kamu setuju untuk membebaskan kami dan event creator dari seluruh tuntutan jika terjadi Force Majeure (gempa bumi, banjir, gunung meletus, tsunami, bencana alam lainnya, pandemik dan/atau epidemik, pernyataan perang, perang, terorisme). </li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#hostingUtilitiesSettings-tab">Tipe Penggolongan Klien Kami</a>
                <div id="hostingUtilitiesSettings-tab" class="collapse fade">
                    <ol>
                        <li> Event creator telah setuju dan sepakat dengan kami sebelum menyelenggarakan acara, dan seluruh kesepakatan wajib dilakukan kecuali terdapat perubahaan yang disetujui oleh kedua belah pihak. </li>
                        <li> Event creator hanya mempublikasikan acara dengan sepengetahuan kami yang tidak mengandun dan melanggar hukum yang berlaku. </li>
                        <li> Jika terjadi sengketa atau acara tersebut melawan hukum, kami tidak bertanggung jawab dengan seluruh tranasaksi pembeli tiket. </li>
                        <li> Event creator bersedia untuk tidak membuat acara yang melawan hukum dan mengandung unsur SARA serta melanggar asusila. </li>
                        <li> Event creator bersedia untuk menginformasikan kepada pembeli jika mereka membatalkan acara yang sedang berjalan dan kami tidak bertanggung jawab atas seluruh transaksi yang telah ditransfer kepada event creator. </li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#marketing-tab">Informasi Pribadi</a>
                <div id="marketing-tab" class="collapse fade">
                    <span> Kami mengumpulkan data pembeli untuk kebutuhan acara. Setiap informasi yang telah kami kumpulkan, akan kami simpan secara aman untuk melindungi informasi personal tiap pembeli. Kami tidak akan menjual data apapun atau informasi pembeli ke pihak manapun, kami menggunakan data tersbut hanya untuk meningkatkan kualitas produk kami termasuk fitur dan pelayanan. Pembeli hanya memberikan informasi yang dibutuhkan oleh penyelenggaran acara untuk menverifikasi data tiket. Berikut merupakan ketentuan tentang informasi konsumen: </span>
                    <ol>
                        <li> Kami hanya mengumpulkan informasi pembeli seperti nama, email, tanggal lahir, jenis kelamin, nomor identitas, nomor telepon dan data lain yang dibutuhkan event creator. </li>
                        <li> Kami akan melindungi data pembeli dengan segenap kekuatan, pengetahuan, dan komitmen kami. </li>
                        <li> Kami hanya menggunakan data pembeli untuk peningkatan kualitas produk kami termasuk fitur dan pelayanan. </li>
                        <li> Kami akan menempuh jalur hukum kepada event creator yang melanggar kesepakatan kami. </li>
                        <li> Kami tidak akan pernah menjual data apapun kepada pihak manapun diluar dari kesepakatan danketentuan kami. </li>
                        <li> Kami memastikan data pembeli akan kami simpan dengan aman. Kami akan meningkatkan teknologi kami untuk melindungi data dari malware dan semacamnya. Kami melarang permintaan data apapun. </li>
                        <li> Kata sandimu digunakan untuk masuk ke akunmu. Jaga kata sandimu dengan hati-hati dan coba untuk membuat password yang tidak biasa. </li>
                        <li> Kami menggunakan enkripsi standar untuk memastikan transaksimu dan datamu aman. </li>
                        <li> Kami menghimbau kamu untuk tidak melakukan apapun yang membahayakan akunmu seperti mempublikasi e-Tiket atau informasi pribadi seperti akunmu. </li>
                        <li> Kami tidak diizinkan untuk mengirim spam, spyware, malware, dan semacamnya ke email lain. Kami sangat memperhatikan hal tersebut dan akan mengambil jalur hukum. </li>
                        <li> Kami dapat menerima data atau informasi personal dari pihak ketiga yang menggunakan platform kami seperti Event creator. Setiap kesepakatan dan ketentuan telah ditulis dan ditandatangani oleh masing-masing pihak. </li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#email-tab">Cookies & Hak Cipta</a>
                <div id="email-tab" class="collapse fade">
                    <h4>Cookies</h4>
                    <span> Kami menggunakan penggunaan cookie. Dengan menggunakan situs web WISDIL anda menyetujui penggunaan cookie sesuai dengan kebijakan privasi WISDIL. Sebagian besar situs web interaktif modern menggunakan cookie untuk memungkinkan kami mengambil detail pengguna untuk setiap kunjungan. Cookie digunakan di beberapa area situs kami untuk mengaktifkan fungsionalitas area ini dan kemudahan penggunaan bagi orang-orang yang berkunjung. Beberapa mitra afliasai / iklan kami juga dapat menggunakan cookie. </span>
                    <h4>Hak Cipta</h4>
                    <span> WISDIL dan/ atau pemberi lisensinya memiliki hak kekayaan intelektual untuk semua materi yang ada di WISDIL. Semua hak kekayaan intelektual dilindungi. Anda dapaat melihat dan/atau mencetak halaman dari WISDIL.co.id untuk penggunaan pribadi. Anda tunduk pada batasan yang ditetapkan dalam syarat dan ketentuan ini. </span>
                    <ol>
                        <li> Event creator sebagai penyelenggara acara dilarang mengeksploitasi data pengguna untuk kepentingan pribadi atau organisasional tanpa izin dari kami. </li>
                        <li> Pengguna dilarang untuk menyalin, modifikasi atau membuat karya turunan dari platform ini. </li>
                        <li> Pengguna dilarang untu menyalin, memodifikasi, atau mengirim e-Tiket tanpa sepengetahuan dari kami dan event creator. </li>
                        <li> Event creator tidak diizinkan untuk meminta data lebih dari customer tanpa sepengetahuan dan izin kami. </li>
                        <li> Pengguna tidak diizinkan menggunakan phising, robot, spider, atau semacam virus lain untuk mengambil keuntungan pribadi atau sesuatu yang melawan hukum dengan mengatasnamakan kami. </li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#ecommerce-tab">Kebijakan Pengembalian Uang</a>
                <div id="ecommerce-tab" class="collapse fade">
                    <span> Berikut adalah kebijakan pengembalian dana kami, setiap pembelian atau transaksi akan mencapai persyaratan yang berbeda. Silahkan baca dengan cermat ketentuan dibawah ini: </span>
                    <ol>
                        <li> Seluruh tiket pembeli yang telah dibeli tidak bias diuangkan kembali. </li>
                        <li> Pengembalian dana hanya untuk pembeli yang memiliki kendala dalam proses pembayaran, contoh seperti system bank dalam proses perbaikan atau error. </li>
                        <li> Kami menghimbau kamu untuk tidak menjual tiketmu ke orang lain. Setiap kendala atau masalah yang disebabkan dari aktivitas tersebut bukan tanggungjawab kami. </li>
                        <li> Jika kamu ingin menjual tiketmu, kamu sebaiknya mengkonfirmasikan terlebuh dahulu kepada event creator atau kami. </li>
                        <li> Kami dapat mengembalikan danamu jika ada bukti transaksi. Jika tidak, tidak kami layani. </li>
                        <li> Bukti transaksi dapat berupa struk transfer atau mutasi rekening. </li>
                        <li> Setiap pengembalian dana yang disebabkan oleh Force Majeure akan diatur oleh event creator. Ketentuan yang berlaku pada proses tersebut adalah ketentuan yang ada pada pihak event creator, dan diluar dari tanggung jawab kami. </li>
                    </ol>
                </div>
                <a class="v-tab-head v-tab-link visible-xs" data-target="#technology-tab">Pembelaan & Domisili Hukum</a>
                <div id="technology-tab" class="collapse fade">
                    <h4>Pembelaan</h4>
                    <span> Sejauh diizinkan oleh hukum yang berlaku, kami mengecualikan semua representasi, jaminan dan ketentuan yang berkaitan denan situs web kami dan penggunaan situs web ini (termasuk, namun tidak terbatas pada, jaminan apa pun yang dinyatakan oleh hukum sehubungan dengan kualitas yang memuaskan, kesesuaian dengan tujuan dan penggunaan perawatan dan keterampilan yang wajar). Tidak ada dalam penafian ini yang akan: </span>
                    <ol>
                        <li> Event creator telah setuju dan sepakat dengan kami sebelum menyelenggarakan acara, dan seluruh kesepakatan wajib dilakukan kecuali terdapat perubahaan yang disetujui oleh kedua belah pihak. </li>
                        <li> Event creator hanya mempublikasikan acara dengan sepengetahuan kami yang tidak mengandun dan melanggar hukum yang berlaku. </li>
                        <li> Jika terjadi sengketa atau acara tersebut melawan hukum, kami tidak bertanggung jawab dengan seluruh tranasaksi pembeli tiket. </li>
                        <li> Event creator bersedia untuk tidak membuat acara yang melawan hukum dan mengandung unsur SARA serta melanggar asusila. </li>
                        <li> Event creator bersedia untuk menginformasikan kepada pembeli jika mereka membatalkan acara yang sedang berjalan dan kami tidak bertanggung jawab atas seluruh transaksi yang telah ditransfer kepada event creator. </li>
                    </ol>
                    <h4>Hukum</h4>
                    <span> Setiap pelanggaran atau perselisihan akan dilakukan di Pengadilan Negeri Kota Yogyakarta. Kami tidak memberikan fasilitas apa pun untuk anda, dan kami tidak akan memberi anda kompensasi apa pun. Setiap pengacara yang ingin anda bela, kami tidak punya niat untuk bertanggung jawab atas akomodasi. Anda harus menyetujui istilah ini jika anda melakukan transaksi di platform kami, kami tidak dapat menerima keluhan atau alas an tidak logis bahwa anda belum membaca atau tidak setuju tentang istilah ini. Intinya jika anda telah membeli atau melakukan tranasaki, maka dinyatakan telah mengerti maupun setuju atas ketentuan ini. </span>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">