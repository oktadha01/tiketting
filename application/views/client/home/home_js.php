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