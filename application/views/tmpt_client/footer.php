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


<script>
    // $(function() {
    //     var url = window.location.href;

    //     // passes on every "a" tag
    //     $("#main-menu a").each(function() {
    //         // checks if its the same on the address bar
    //         if (url == (this.href)) {
    //             $(this).closest(".menu").addClass("active");
    //         }
    //     });
    //     // this will get the full URL at the address bar
    // });
    // $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    // });
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