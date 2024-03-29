<script>
$(function() {
    const swiper = new Swiper('.slider1', {
        spaceBetween: 20, //何ピクセル画像の間隔をあけるか
        centeredSlides: true, //見切らせたい場合メイン画像をセンターにもってくるか
        // centerMode: true,
        // // centerPadding: '10%',
        slidesPerView: 1, //画像を何枚表示するか
        breakpoints: { //レスポンシブ ※小さい幅から指定する
            600: {
                slidesPerView: 1.5,
            },
            // 1200px以上の場合
            1200: {
                slidesPerView: 2.5,
            },
        },
        //自動再生する場合
        autoplay: {
            delay: 3000, //3秒後に次の画像に代わる
        },

        loop: true, //最後の画像までいったらループする

        //ページネーションをつける場合 ※HTMLと合わせる
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },

        //左右のナビゲーションをつける場合 ※HTMLと合わせる
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