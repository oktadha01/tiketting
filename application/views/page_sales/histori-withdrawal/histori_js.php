<script>
    $(document).ready(function() {
        var table;

        table = $('#data-histori-withdrawal').DataTable({
            "paging": true,
            "autoWidth": true,
            "searching": true, // Corrected property name from "search" to "searching"
            "responsive": true,
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Histori_withdrawal/get_histori_withdrawal') ?>",
                "type": "POST",
            },
        });

        // Use delegated event handling for dynamically loaded elements
        $('#data-histori-withdrawal tbody').on('click', '.btn-no-wd', function() {
            $('.nominal').text($(this).data('nominal'));
            $('.biaya').text($(this).data('biaya'));
            $('.total').text($(this).data('total'));
            $.ajax({
                url: "<?php echo base_url(); ?>Histori_withdrawal/detail_withdrawal_event",
                method: "POST",
                data: {
                    event_id: $(this).data('id-event'),
                },
                cache: false,
                success: function(data) {
                    // alert(data);
                    $('#load-detail-withdrawal').html(data)
                }
            });
        });
    });
</script>