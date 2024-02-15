<script>
    $(document).ready(function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        $(function() {

            $('.select-kota').select2({
                placeholder: "Pilih Kota/Kabupaten",
                allowClear: true,
                // minimumResultsForSearch: Infinity
            });
        })
        populateKota();

        var delayInMilliseconds = 500; //1 second
        setTimeout(function() {
            <?php foreach ($customer as $data) { ?>
                $('#email-login').val('<?= $data->email; ?>');
                $('.email-2').val('<?= $data->email; ?>');
                $('.nama-2').val('<?= $data->nm_customer; ?>');
                $('.tgl-lahir-2').val('<?= $data->tgl_lahir; ?>');
                $('#gender-2').val('<?= $data->gender; ?>');
                $("#gender-<?= $data->gender; ?>-2").prop("checked", true)

                $('.kontak-2').val('<?= $data->kontak; ?>');
                $('.no-identitas-2').val('<?= $data->no_identitas; ?>');
                $('.kota-2').val('<?= $data->kota; ?>').trigger('change');
            <?php
            } ?>
        }, delayInMilliseconds);

        function populateKota() {
            $.ajax({
                url: '<?= base_url('Buynow/get_ajax_kab') ?>',
                type: 'GET',
                success: function(data) {
                    $('.select-kota').html(data);

                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
        }

        window.addEventListener('popstate', () => {
            const currentUrl = '<?= base_url('detail/event/'); ?><?= $this->uri->segment(3); ?>';
            window.history.pushState({}, '', currentUrl);
            detail_event();
        });
    });

    $('.ceklis-same-regis').click(function() {
        var get_email = $('.email-2').val();
        var get_nama = $('.nama-2').val();
        var get_tgl_lahir = $('.tgl-lahir-2').val();
        var get_gender = $('#gender-2').val();
        var get_no_wa = $('.kontak-2').val();
        var get_no_identitas = $('.no-identitas-2').val();
        var get_kota = $('.kota-2').val();
        $("#gender-male-" + $(this).val()).prop("checked", false);
        $("#gender-female-" + $(this).val()).prop("checked", false);
        if ($(this).is(":checked")) {
            // alert($(this).val())
            $('.email-' + $(this).val()).val(get_email);
            $('.nama-' + $(this).val()).val(get_nama);
            $('.tgl-lahir-' + $(this).val()).val(get_tgl_lahir);
            $('#gender-' + $(this).val()).val(get_gender);
            $('.kontak-' + $(this).val()).val(get_no_wa);
            $('.no-identitas-' + $(this).val()).val(get_no_identitas);
            $('.kota-' + $(this).val()).val(get_kota).trigger('change');
            $("#gender-" + get_gender + "-" + $(this).val()).prop("checked", true)
        } else {
            $('.email-' + $(this).val()).val('');
            $('.nama-' + $(this).val()).val('');
            $('.tgl-lahir-' + $(this).val()).val('');
            $('#gender-' + $(this).val()).val('');
            $('.kontak-' + $(this).val()).val('');
            $('.no-identitas-' + $(this).val()).val('');
            $('.kota-' + $(this).val()).val('');
            $("#gender-male-" + $(this).val()).prop("checked", false)
            $("#gender-female-" + $(this).val()).prop("checked", false)

        }
    });
    $('.gender').click(function() {
        $('.gender-' + $(this).data('no')).not(this).prop('checked', false);
        if ($(this).is(":checked")) {
            $('#gender-' + $(this).data('no')).val($(this).val())
        }
    });
    $("#select-metode, #select-payment").select2({
        placeholder: "Pilih ...",
        allowClear: true
    });
    $('.notif-call-log').hide();
    $('#submit').hide();
    $('#btn-submit-login').click(function() {
        // if ($('.form-control').val() == ''){
        //     $('.form-control').required;
        // }else{
        //     alert($('.form-control').val());
        // }
        $('.show-modal-pass').trigger('click');

    });

    $('#btn-login').click(function() {

        let formData = new FormData();
        formData.append('email', $('#email-login').val());
        formData.append('password', $('#password-login').val());
        formData.append('remember', $('#remember').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Auth/insert_password'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('.notif-call-log').show(200);
                $('#btn-login, #btn-close-modal').hide();
                $('#submit').show(200);
                $('#password-login').attr('readonly');
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    });

    $('#submit, #btn-submit').click(function() {
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {

            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    });

    // END EDIT OKTA

    // animasi loading

    function submitWithLoading(buttonId) {
        var btnTextId = buttonId == 'btn-submit-login' ? 'btn-text-login' : 'btn-text';
        var btnLoadingId = buttonId == 'btn-submit-login' ? 'btn-loading-login' : 'btn-loading';

        var btnText = document.getElementById(btnTextId);
        var btnLoading = document.getElementById(btnLoadingId);

        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';

        setTimeout(function() {
            btnText.style.display = 'inline-block';
            btnLoading.style.display = 'none';
        }, 7000);
    }
    $('#tgl-lahir').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
            format: 'DD-MM-YYYY'
        },
        autoclose: true
    });
</script>
<script>
    // var bank = '<div class="col">' +
    //     '<div class="form-group">' +
    //     '<label class="label-pembayaran"></label>' +
    //     '<select type="text" id="select-payment" required="" class="form-control">' +
    //     '<option val=""></option>' +
    //     '<option val="bca">BCA</option>' +
    //     '<option val="bni">BNI</option>' +
    //     '<option val="bri">BRI</option>' +
    //     '<option val="mandiri">MANDIRI</option>'
    // '</select>' +
    // '</div>' +
    // '</div>';

    // var ewallet = '<div class="col">' +
    //     '<div class="form-group">' +
    //     '<label class="label-pembayaran"></label>' +
    //     '<select type="text" id="select-payment" required="" class="form-control">' +
    //     '<option val=""></option>' +
    //     '<option val="shopee">Shopee</option>' +
    //     '<option val="ovo">OVO</option>' +
    //     '<option val="dana">DANA</option>' +
    //     '</select>' +
    //     '</div>' +
    //     '</div>';
    // // EDIT OKTA
    // $('.row-payment').hide();
    // $('#select-metode').change(function() {
    //     var val_select = $('#select-metode').find(":selected").val();
    //     if (val_select == 'bank transfer') {
    //         $('.row-payment').show();
    //         $('.row-payment').html(bank);
    //         $('.label-pembayaran').text('Pilih Bank Pembayaran');
    //         $('#payment').val('');

    //     } else if (val_select == 'qris') {
    //         $('.row-payment').hide();
    //         $('.row-payment').html('');
    //         $('#payment').val(val_select);

    //     } else if (val_select == 'ewallet') {

    //         $('.row-payment').show();
    //         $('.row-payment').html(ewallet);
    //         $('.label-pembayaran').text('Pilih Ewallet Pembayaran');
    //         $('#payment').val('');
    //     }
    //     $("#select-metode, #select-payment").select2({
    //         placeholder: "Pilih ...",
    //         allowClear: true
    //     });
    //     $('#select-payment').change(function() {
    //         var val_select_payment = $('#select-payment').find(":selected").val();
    //         $('#payment').val(val_select_payment);
    //     });
    // });
</script>