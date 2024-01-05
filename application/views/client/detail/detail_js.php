<script src="<?= base_url('assets'); ?>/js/email_validasi.js"></script>

<script>
    $(document).ready(function() {
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
                // alert('ya');
                $('#btn-add-' + $(this).data('tiket')).show()
                $('#count-' + $(this).data('tiket')).attr('hidden', true);
                $('.btn-checkout').attr('disabled', true);
            }
            var subtotal = parseInt($('#in-subtotal').val()) - harga;
            $('#in-subtotal').val(subtotal);
            let rupiahFormat = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            $('#subtotal').text('Rp.' + rupiahFormat + ',-');
            return false;
        });
        $('.plus').click(function() {
            var $input = $(this).parent().find('.input-count');
            var count = parseInt($input.val()) + 1;
            var harga = $(this).data('harga');
            count = count <= 0 ? 0 : count;
            $input.val(count);
            $input.change();
            $('.btn-checkout').removeAttr('disabled', true);
            var subtotal = parseInt($('#in-subtotal').val()) + harga;
            $('#in-subtotal').val(subtotal);
            let rupiahFormat = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            $('#subtotal').text('Rp.' + rupiahFormat + ',-');
            return false;
        });
        $('#form-pass').hide();
        $('.remember').hide();
        $('#remember').click(function() {
            if ($(this).is(":checked")) {
                $(this).val('1')
            }
        });

        $('#btn-sumbmit').click(function() {
            buynow_event();
            window.history.pushState({}, null, null);
        });

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
                        $('.remember').show();
                        $('#btn-sumbmit').text('submit');
                    } else if (data == 'gagal-login') {
                        $('#password').addClass('invalid')
                        $('.valid_pass').text('Wrong Password !!')
                    } else {
                        $('#form-pass').hide();
                        $('#btn-close-modal').trigger('click');
                        var delayInMilliseconds = 500; //1 second
                        setTimeout(function() {
                            $('#page-load-detail-event').html(data);
                            window.history.pushState({}, null, null);
                        }, delayInMilliseconds);

                    }
                    $('#email').on('keypress', function() {
                        $('#form-pass').hide();
                        $('.remember').hide().prop("checked", false).val('');
                        $('#btn-sumbmit').text('Next');
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