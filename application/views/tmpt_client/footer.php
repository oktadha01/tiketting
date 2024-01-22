<footer class="footer pt-12 ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-sm-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © 2023
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.kanpa.co.id" class="font-weight-bold" target="_blank"> Kanpa.co.id</a>
                    Event PT Kanpa (Beta Vers).
                </div>
            </div>
            <div class="col-lg-6">
            </div>
        </div>
    </div>
</footer>
<!-- Javascript -->

<!-- page vendor js file -->
<script src="<?= base_url('assets'); ?>/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?= base_url('assets'); ?>/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/toastr/toastr.js"></script>
<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- daterange -->
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- page js file -->
<script src="<?= base_url('assets'); ?>/vendor/nouislider/nouislider.js"></script>
<script src="<?= base_url('assets'); ?>/bundles/mainscripts.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/js/advanced-form-elements.js"></script>
<script src="<?= base_url('assets'); ?>/js/slide_navigation.js"></script>
<script src="<?= base_url('assets'); ?>/js/index.js"></script>
<!-- add Plugin -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    var url_transaksi = '<?php echo site_url('Transaction/data'); ?>';
    var url_tiket = '<?php echo site_url('E_tiket/data'); ?>';
    var url_detail_trans = '<?php echo site_url('transaction/detail_trans'); ?>';
    var url_detail_tiket = '<?php echo site_url('E_tiket/detail_tiket'); ?>';
    var url_download_tiket = '<?= site_url('upload/pdf/'); ?>'
    var url_qr = '<?= base_url('upload/qr/'); ?>'
    var url = '<?= base_url(); ?>';

    // Panggil fungsi saat halaman dimuat atau saat ukuran jendela berubah
    window.addEventListener('resize', cekTipePerangkat);
    cekTipePerangkat(); // Panggil fungsi saat halaman dimuat
    const menuLinks = document.querySelectorAll(".menu-link");

    menuLinks.forEach((link) => {
        link.addEventListener("click", () => {
            menuLinks.forEach((link) => {
                link.classList.remove("is-active");
            });
            link.classList.add("is-active");
        });
    });

</script>