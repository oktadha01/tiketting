<!-- page vendor js file -->
<script src="<?= base_url('assets'); ?>/vendor/toastr/toastr.js"></script>
<!-- page js file -->
<script src="<?= base_url('assets'); ?>/bundles/libscripts.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/bundles/vendorscripts.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/bundles/mainscripts.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/bundles/easypiechart.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/pages/forms/advanced-form-elements.js"></script>
<script src="<?= base_url('assets'); ?>/bundles/c3.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/nouislider/nouislider.js"></script>
<script src="<?= base_url('assets'); ?> /js/pages/ui/dialogs.js"></script>

<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- datatables -->
<script src="<?= base_url('assets'); ?>/bundles/datatablescripts.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<!-- daterange -->
<script src="<?= base_url('assets'); ?>/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- dropify -->
<script src="<?= base_url('assets'); ?>/vendor/dropify/js/dropify.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/pages/forms/dropify.js"></script>

<script>
$(function() {
    var url = window.location.href;

    $("#main-menu a").each(function() {
        if (url == (this.href)) {
            $(this).closest(".menu").addClass("active");
        }
    });
});
</script>

<script>
$('[data-provide="datepicker"]').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true
});
</script>
<script src="https://unpkg.com/html5-qrcode"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.0/html5-qrcode.min.js"></script> -->