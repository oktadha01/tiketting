<script>
    // $('.btn').click(function() {\
    let addurl;
    if ('<?= $this->uri->segment(4); ?>' == 'buynow') {
        buynow_event();
    } else {
        detail_event();
    }


    // window.addEventListener('popstate', () => {
    //     console.log('User clicked back button');

    //     // document.body.style.backgroundColor = 'white';
    //     detail_event();
    // });

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
</script>