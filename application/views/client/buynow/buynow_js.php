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
                $("#gender-<?= $data->gender; ?>-2").prop("checked", true);
                $('.kota-2').val('<?= $data->kota; ?>').trigger('change');

                $('.kontak-2').val('<?= $data->kontak; ?>');
                <?php if ($data->no_identitas == '0' && $this->input->cookie('session') == '') { ?>
                    $('.no-identitas-2').val('0');
                <?php
                } else { ?>
                    $('.no-identitas-2').val('<?= $data->no_identitas; ?>');
                <?php
                }
                ?>
            <?php
            } ?>
            <?php
            if ($this->input->cookie('session') == '') { ?>
            <?php
            } else { ?>
                $('.email-2,.nama-2,.kontak-2,.no-identitas-2').attr('readonly', true);
                $('.kota-2,.tgl-lahir-2').attr('disabled', true);
                $('#gender-male-2, #gender-female-2').attr('disabled', true);
                $('.email-2,.nama-2,.kontak-2,.no-identitas-2').click(function() {
                    Swal.fire({
                        title: "Readonly !",
                        text: "Jika ingin edit data, silahkan ke menu user akun!",
                        icon: "error"
                    });
                });
            <?php
            }
            ?>
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
            if (get_email == '' || get_nama == '' || get_tgl_lahir == '' || get_gender == '' || get_no_wa == '' || get_no_identitas == '' || get_kota == '') {
                validate_form();
                $(this).prop("checked", false);
            } else {

                $('.email-' + $(this).val()).val(get_email);
                $('.nama-' + $(this).val()).val(get_nama);
                $('.tgl-lahir-' + $(this).val()).val(get_tgl_lahir);
                $('#gender-' + $(this).val()).val(get_gender);
                $('.kontak-' + $(this).val()).val(get_no_wa);
                $('.no-identitas-' + $(this).val()).val(get_no_identitas);
                $('.kota-' + $(this).val()).val(get_kota).trigger('change');
                $("#gender-" + get_gender + "-" + $(this).val()).prop("checked", true);
            }
        } else {
            $('.email-' + $(this).val()).val('');
            $('.nama-' + $(this).val()).val('');
            $('.tgl-lahir-' + $(this).val()).val('');
            $('#gender-' + $(this).val()).val('');
            $('.kontak-' + $(this).val()).val('');
            $('.no-identitas-' + $(this).val()).val('');
            $('.kota-' + $(this).val()).val('').trigger('change');
            $("#gender-male-" + $(this).val()).prop("checked", false);
            $("#gender-female-" + $(this).val()).prop("checked", false);

        }
    });

    $('.gender').click(function() {
        $('.gender-' + $(this).data('no')).not(this).prop('checked', false);
        if ($(this).is(":checked")) {
            $('#gender-' + $(this).data('no')).val($(this).val())
        }
    });

    $('.notif-call-log').hide();
    $('#submit').hide();
    $('#btn-submit-login').click(function() {
        var email = document.getElementsByName("email[]");
        for (var i = 0; i < email.length; i++) {
            if (!email[i].value) {
                var text_notif = 'Silahkan isi form dengan lengkap !'
                validate_form(text_notif);
                return;
            }
        }
        var nama = document.getElementsByName("nama[]");
        for (var i = 0; i < nama.length; i++) {
            if (!nama[i].value) {
                var text_notif = 'Silahkan isi form dengan lengkap !'
                validate_form(text_notif);
                return;
            }
        }
        var tgl_lahir = document.getElementsByName("tgl_lahir[]");
        for (var i = 0; i < tgl_lahir.length; i++) {
            if (!tgl_lahir[i].value) {
                var text_notif = 'Silahkan isi form dengan lengkap !'
                validate_form(text_notif);
                return;
            } else {
                var tanggalLahirString = tgl_lahir[i].value;

                // Pisahkan tanggal, bulan, dan tahun
                var parts = tanggalLahirString.split("-");
                var tanggalLahir = new Date(parts[2], parts[1] - 1, parts[0]); // tahun, bulan (dimulai dari 0), tanggal

                // Tanggal saat ini
                var tanggalSaatIni = new Date();

                // Hitung selisih tahun
                var selisihTahun = tanggalSaatIni.getFullYear() - tanggalLahir.getFullYear();

                // Periksa apakah ulang tahun sudah terjadi pada tahun ini
                if (tanggalSaatIni.getMonth() < tanggalLahir.getMonth() || (tanggalSaatIni.getMonth() === tanggalLahir.getMonth() && tanggalSaatIni.getDate() < tanggalLahir.getDate())) {
                    selisihTahun--;
                }

                console.log("Umur: " + selisihTahun + " tahun");
                if (selisihTahun < '10') {
                    tgl_lahir[i].classList.add('invalid-input', true);
                    var text_notif = 'Tanggal lahir sesuai identitas'
                    validate_form(text_notif);
                    return;
                }
            }
        }
        var kontak = document.getElementsByName("kontak[]");
        for (var i = 0; i < kontak.length; i++) {
            if (!kontak[i].value) {
                var text_notif = 'Silahkan isi form dengan lengkap !'
                validate_form(text_notif);
                return;
            }
        }
        var no_identitas = document.getElementsByName("no_identitas[]");
        for (var i = 0; i < no_identitas.length; i++) {
            if (!no_identitas[i].value) {
                var text_notif = 'Silahkan isi form dengan lengkap !'
                validate_form(text_notif);
                return;
            }
        }
        var kota = document.getElementsByName("kota[]");
        for (var i = 0; i < kota.length; i++) {
            if (!kota[i].value) {
                var text_notif = 'Silahkan isi form dengan lengkap !'
                validate_form(text_notif);
                return;
            }
        }
        $('.show-modal-pass').trigger('click');
    })
    // // $(function() {
    //     $('input[name="tgl_lahir[]"]').daterangepicker({
    //         singleDatePicker: true,
    //         showDropdowns: true,
    //         minYear: 1901,
    //         maxYear: parseInt(moment().format('YYYY'), 10)
    //     }, function(start, end, label) {
    //         var years = moment().diff(start, 'years');
    //         alert("You are " + years + " years old!");
    //     });
    // // });

    function validate_form(text_notif) {
        Swal.fire({
            title: "Proses Gagal !",
            text: text_notif,
            icon: "error"
        });
    }

    $('#btn-login').click(function() {
        if ($('#password-login').val() == '') {
            $('#password-login').addClass('invalid-pass-error', true);
            $('.text-invalid-pass').text('Password tidak boleh kosong!')
        } else {
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
                    $('#password-login').attr('readonly', true);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        };
    });
    $('#password-login').on('input', function() {
        if ($('#password-login').val() == '') {
            $('#password-login').addClass('invalid-pass-error', true);
            $('.text-invalid-pass').text('Password tidak boleh kosong!')
        } else {
            $('#password-login').removeClass('invalid-pass-error', true);
            $('.text-invalid-pass').text('')
        }
    });

    $('form').submit(function() {
        $('.kota-2,.tgl-lahir-2').prop('disabled', false);
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

    $(function() {
        var tglLahirInput = $('.tgl-lahir');

        tglLahirInput.daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
                format: 'DD-MM-YYYY'
            },
            autoclose: true,
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
            // alert("You are " + years + " years old!");
            if (years > 10) {
                tglLahirInput.removeClass('invalid-input');
            }
        });
    });
    document.getElementById("myForm").addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
</script>