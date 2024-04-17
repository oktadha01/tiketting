<script>
$(document).ready(function() {
    // conten artikle

    var limit = 1;
    var start = 0;
    var action = 'inactive';

    function lazy_loader() {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        $('.load_data_message').html(output);
    }

    lazy_loader();

    function load_data(limit, start, search = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>Berita/berita_article",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                search: search
            },
            cache: false,
            success: function(data) {
                $('#load_data').append(data);
                $('.load_data_message').html("");
                action = 'inactive';
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        load_data(limit, start);
    }

    function reload_data() {
        $('#load_data').html('');
        lazy_loader();
        load_data(limit, start);
    }

});

$(document).ready(function() {

    // conten menu popular post
    var limit = 2;
    var start = 0;
    var action = 'inactive';

    function lazy_loader_pop() {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 200px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        $('.load_message_pop').html(output);
    }

    lazy_loader_pop();

    function load_popular_post(limit, start) {
        $.ajax({
            url: "<?php echo base_url(); ?>Berita/popular_post",
            method: "POST",
            data: {
                limit: limit,
                start: start,
            },
            cache: false,
            success: function(data) {
                $('#load_popular_post').append(data);
                $('.load_message_pop').html("");
                action = 'inactive';
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        load_popular_post(limit, start);
    }
});

$(document).ready(function() {

    // conten menu popular post
    var limit = 20;
    var start = 0;
    var action = 'inactive';

    function lazy_loader_tags() {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;"></span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 40px;"></span></p>';
        output += '</div>';
        $('.load_message_tags').html(output);
    }

    lazy_loader_tags();

    function load_data_tags(limit, start) {
        $.ajax({
            url: "<?php echo base_url(); ?>Berita/data_tags",
            method: "POST",
            data: {
                limit: limit,
                start: start,
            },
            cache: false,
            success: function(data) {
                $('#data-tags').append(data);
                $('.load_message_tags').html("");
                action = 'inactive';
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        load_data_tags(limit, start);
    }
});

$(document).ready(function() {

    var limit = 8;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader_more(limit) {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 90px;">&nbsp;</span></p>';
        output += '</div>';
        $('.message_berita_more').html(output);
    }

    lazzy_loader_more(limit);

    function load_data_more(limit, start) {
        $.ajax({
            url: "<?php echo base_url(); ?>Berita/more_berita",
            method: "POST",
            data: {
                limit: limit,
                start: start
            },
            cache: false,
            success: function(data) {
                if (data == '') {
                    $('.message_berita_more').html('');
                    $('#read-more-art').hide();
                    action = 'active';
                } else {
                    $('#data-more').append(data);
                    $('.message_berita_more').html('');
                    action = 'inactive';
                }
            }
        })
    }

    if (action == 'inactive') {
        action = 'active';
        load_data_more(limit, start);
    }

    // Tombol Next Page
    $(document).on('click', '#read-more-art', function() {
        if (action == 'inactive') {
            lazzy_loader_more(limit);
            action = 'active';
            start = start + limit;
            setTimeout(function() {
                load_data_more(limit, start);
            }, 900);
        }
    });

});

$(document).ready(function() {
    // detail conten artikle

    var limit = 10;
    var start = 0;
    var action = 'inactive';

    function lazy_loader() {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        $('.load_message_detail').html(output);
    }

    lazy_loader();

    function load_data(limit, start) {
        $.ajax({
            url: "<?php echo base_url('Berita/detail_article/') . $this->uri->segment(3); ?>",
            method: "POST",
            data: {
                limit: limit,
                start: start,
            },
            cache: false,
            success: function(data) {
                $('#load_data_detail').append(data);
                $('.load_message_detail').html("");
                action = 'inactive';
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        load_data(limit, start);
    }

});

// data tags
$(document).ready(function() {
    // detail conten artikle

    var limit = 8;
    var start = 0;
    var action = 'inactive';

    function lazy_loader() {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        $('.load_message_tags').html(output);
    }

    lazy_loader();

    function load_data(limit, start) {
        $.ajax({
            url: "<?php echo base_url('Berita/get_data_tags/') . $this->uri->segment(3); ?>",
            method: "POST",
            data: {
                limit: limit,
                start: start,
            },
            cache: false,
            success: function(data) {
                $('#load_data_tags').append(data);
                $('.load_message_tags').html("");
                action = 'inactive';
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        load_data(limit, start);
    }

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $("#load_data_tags").height() && action ==
            'inactive') {
            lazzy_loader(limit);
            action = 'active';
            start = start + limit;
            setTimeout(function() {
                load_data(limit, start);
            }, 1000);
        }
    });
});

$(document).on('click', '.add-view', function() {
    var id_article = $(this).data('id_article');

    $.ajax({
        type: 'POST',
        url: "<?php echo site_url('Berita/add_views'); ?>",
        data: {
            id_article: id_article
        },
        success: function(data) {
            console.log("ID Artikel:", id_article);
            console.log(data);
        },
        error: function(xhr, status, error) {

        }
    });

});
</script>