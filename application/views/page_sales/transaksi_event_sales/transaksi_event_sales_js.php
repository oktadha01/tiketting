<script>
    $(document).ready(function() {
        var table;

        table = $('#data-transaksi').DataTable({
            "paging": true,
            "autoWidth": true,
            "search": true,
            "responsive": true,
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Transaksi_event_sales/get_datatransaksi') ?>",
                "type": "POST",
            },

        })
    });
</script>