<script src="<?= base_url('assets'); ?>/js/email_validasi.js"></script>

<script>
    $(document).ready(function() {
       
        let addurl;
        $('.t-right').click(function() {
            $('.right').toggleClass('nav-active');
            let addurl = '/tiket';
            const newPageUrl = '<?= base_url('detail/event/'); ?><?= $this->uri->segment(3); ?>' + addurl;
            window.history.pushState({}, null, newPageUrl);
            window.addEventListener('popstate', () => {
                $('.btn-close-tiket').trigger('click');
                const currentUrl = '<?= base_url('detail/event/'); ?><?= $this->uri->segment(3); ?>';
                window.history.pushState({}, '', currentUrl);
            });
        });
        $('.btn-close-tiket').click(function() {
            $('.right').toggleClass('nav-active');
        })


        $('.btn-add-tiket').click(function() {
            $(this).hide()
            $('#count-tiket' + $(this).data('tiket')).removeAttr('hidden', true);
        });
        // var total = '0';
        $('.minus').click(function() {
            var $input = $(this).parent().find('.input-count');
            var count = parseInt($input.val()) - 1;
            var harga = $(this).data('harga');
            count = count <= 0 ? 0 : count;
            $input.val(count);
            $input.change();
            if (count == 0) {
                $('#btn-add-tiket' + $(this).data('tiket')).show();
                $('#count-tiket' + $(this).data('tiket')).attr('hidden', true);
            }
            var subtotal = parseInt($('#in-subtotal').val()) - harga;
            $('#in-subtotal').val(subtotal);
            let rupiahFormat = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            $('#subtotal').text('Rp.' + rupiahFormat + ',-');
            if ($('#in-subtotal').val() <= '0') {
                $('.btn-checkout').attr('disabled', true);
            }
            return false;
        });
        $('.plus').click(function() {
            var $input = $(this).parent().find('.input-count');
            var count = parseInt($input.val()) + 1;
            var harga = $(this).data('harga');
            var status = $(this).data('status');
            var tiket = $(this).data('tiket');
            count = count <= 0 ? 0 : count;
            if (status == '1' && count > '1') {
                var delayInMilliseconds = 1800; //1 second
                $('#load-max-' + tiket).html('<span class="infomax">Maaf! Max 1 tiket</span>')
                setTimeout(function() {
                    $('#load-max-' + tiket).html('')
                }, delayInMilliseconds);

                // alert('bundling')
                $input.val('1');
                $input.change();
            } else if (status == '0' && count > '5') {
                var delayInMilliseconds = 1800; //1 second
                $('#load-max-' + tiket).html('<span class="infomax">Maaf! Max 5 tiket</span>')
                setTimeout(function() {
                    $('#load-max-' + tiket).html('')
                }, delayInMilliseconds);

                // alert('standar')
                $input.val('5');
                $input.change();
            } else {
                $input.val(count);
                $input.change();

                $('.btn-checkout').removeAttr('disabled', true);
                var subtotal = parseInt($('#in-subtotal').val()) + harga;
                $('#in-subtotal').val(subtotal);
                let rupiahFormat = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                $('#subtotal').text('Rp.' + rupiahFormat + ',-');
                return false;
            }
        });

        $('#form-pass').hide();
        // $('.remember').hide();
        $('#remember').click(function() {
            if ($(this).is(":checked")) {
                $(this).val('1')
            }
        });
        $('#email').on('input', function() {
            // alert('yaa')
            if ($(this).attr('class') == 'form-control valid') {
                $('#btn-next').removeAttr('disabled')
            } else {
                $('#btn-next').attr('disabled')

            }
        });
        $('#btn-next').click(function() {
            if ($('#email').attr('class') == 'form-control valid') {
                buynow_event();
                // $('#btn-next').removeAttr('disabled')
            } else {
                $('#btn-next').attr('disabled')
            }

        });
        $('#btn-submit').click(function() {
            cek_transaksi();
        });

        function cek_transaksi() {
            let formData = new FormData();
            formData.append('event', '<?= $this->uri->segment(3); ?>');
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Detail/cek_transaksi'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data == 'buy') {
                        buynow_event();
                        let addurl = '/buynow';
                        const newPageUrl = '<?= base_url('detail/event/'); ?><?= $this->uri->segment(3); ?>' + addurl;
                        window.history.pushState({}, null, newPageUrl);
                    } else {
                        swal_vali_transaksi()
                    }
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }

        function swal_vali_transaksi() {
            Swal.fire({
                title: "Maaf! Anda masih memiliki transaksi sebelumnya",
                text: "selesaikan transaksi dahulu atau batalkan transaksi sebelumnya!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "lihat transaksi anda"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.transaksi').trigger('click');
                }
            });
        }

        function buynow_event() {
            var kategori_tiket = [];
            $('input[name="kategori_tiket[]"]').map(function() {
                kategori_tiket.push($(this).val());
            });
            var count_tiket = [];
            $('input[name="count_tiket[]"]').map(function() {
                count_tiket.push($(this).val());
            });
            $('#data-kategori').val(kategori_tiket);
            var arr = {}
            let formData = new FormData();
            formData.append('kategori_tiket', kategori_tiket);
            formData.append('count_tiket', count_tiket);
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('remember', $('#remember').val());

            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Detail/buynow'); ?>/<?= $this->uri->segment(3); ?>",
                // contentType: "application/json",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    // alert(data);
                    if (data == 'show') {
                        $('#form-pass').show();
                        // $('.remember').show();
                        $('#btn-next').text('submit');
                        $("#remember").prop("checked", true);

                    } else if (data == 'gagal-login') {
                        $('#password').addClass('invalid')
                        $('.valid_pass').text('Wrong Password !!')
                    } else {
                        $('#form-pass').hide();
                        $('#btn-close-modal').trigger('click');
                        var delayInMilliseconds = 500; //1 second
                        setTimeout(function() {

                            $('#page-load-detail-event').html(data);
                           
                            // window.history.pushState({}, null, null);
                        }, delayInMilliseconds);
                       

                    }
                    $('#email').on('keypress', function() {
                        $('#form-pass').hide();
                        // $('.remember').hide().prop("checked", false).val('');
                        $('#btn-next').text('Next');
                        $('#password').removeClass('invalid').val('')
                        $('.valid_pass').text('')
                    });
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });

        }

    });
</script>