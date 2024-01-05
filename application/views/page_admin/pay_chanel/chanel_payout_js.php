<script>
$('#virtual-account').submit(function(event) {
    event.preventDefault();

    var ext_id = $('#external_id').val();
    var bank_code = $('#bank_code').val();
    var name_va = $('#name-va').val();

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('Dashboard/virtual_account') ?>',
        data: {
            ext_id: ext_id,
            bank_code: bank_code,
            name_va: name_va,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'User Berhasil Dibuat.',
                });

                location.reload();
            } else {
                console.error('Terjadi kesalahan saat validasi data di server.');

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat validasi data di server.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);

            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mengirim data ke server.',
            });
        }
    });
});
</script>