<script>
$(function() {
    const swiper = new Swiper('.slider1', {
        spaceBetween: 20,
        centeredSlides: true,
        slidesPerView: 1,
        breakpoints: {
            600: {
                slidesPerView: 1.5,
            },
            1200: {
                slidesPerView: 2.5,
            },
        },
        autoplay: {
            delay: 3000,
        },

        loop: true,

        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }

    });

});
</script>
<script>
$(document).ready(function() {
    $('.testimonial-slider').slick({
        autoplay: true,
        autoplaySpeed: 800,
        speed: 900,
        draggable: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});
</script>
<script>
const splide = new Splide(".splide", {
    // Optional parameters
    start: 1,
    perPage: 1.5,
    perMove: 1,
    gap: 20,
    type: "loop",
    drag: "free",
    snap: false,
    interval: 3000,
    arrows: true,
    pagination: true,
    rewind: true,
    rewindByDrag: true,
    lazyLoad: true,

    // Responsive breakpoint
    breakpoints: {
        768: {
            perPage: 1,
            snap: true
        }
    }
});

splide.mount();
</script>

<script>
$(document).ready(function() {

    var limit = 6;
    var start = 0;
    var action = 'inactive';

    function lazy_loader() {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        $('#load_data_message').html(output);
    }

    lazy_loader();

    function load_data(limit, start, search = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>Home/berita",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                search: search
            },
            cache: false,
            success: function(data) {
                $('#load_data').append(data);
                $('#load_data_message').html("");
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
            console.log("ID Artikel:", id_article);
            console.log("Error:", error);
            alert("Gagal memperbarui artikel.");
        }
    });

});
</script>