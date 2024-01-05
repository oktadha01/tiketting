<script>
    // $('.btn').click(function() {\
    if ('<?= $this->uri->segment(4); ?>' == 'buynow') {
        buynow_event();
    } else {
        detail_event();
    }
    window.addEventListener('popstate', () => {
        console.log('User clicked back button');

        // document.body.style.backgroundColor = 'white';
        detail_event();
    });

    function detail_event() {

        $.ajax({
            // type: 'POST',
            url: "<?php echo site_url('Detail/detail'); ?>/<?= $this->uri->segment(3); ?>",
            // data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#page-load-detail-event').html(data);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function buynow_event() {
        // alert($("input[name='kategori_tiket']").val())
        // let formData = new FormData();
        // formData.append('kategori_tiket', $("input[name='kategori_tiket']").val());
        // formData.append('count_tiket', $("input[name='count_tiket']").val());

        // $.ajax({
        //     type: 'POST',
        //     url: "<?php echo site_url('Detail/buynow'); ?>",
        //     data: formData,
        //     cache: false,
        //     processData: false,
        //     contentType: false,
        //     success: function(data) {
        //         $('#page-load-detail-event').html(data);
        //     },
        //     error: function() {
        //         alert("Data Gagal Diupload");
        //     }
        // });

    }
</script>