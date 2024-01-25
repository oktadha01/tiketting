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
    // Images Area Images
    let imagesAreaImages = document.querySelectorAll('.images-area img');
    // Images Area First Image
    let imagesAreaFirstImage = document.querySelector('.images-area .firstImage');

    // Previous And Next Buttons
    let previousBtn = document.querySelector('.previous-btn');
    let nextBtn = document.querySelector('.next-btn');

    // Pagination Area 
    let paginationArea = document.querySelector('.pagination-area');

    // Current Image Count
    let currentImageCount = 1;

    // Slider Controler Function
    let sliderController;
    // Create Pagination Spans Function
    let createPaginationSpans;

    // Every Click On Buttons
    previousBtn.addEventListener('click', previousImage);
    nextBtn.addEventListener('click', nextImage);


    // Previous Image Function
    function previousImage() {
        // If The currentImageCount Is 1
        if (currentImageCount === 1) {
            return false;
        } else { // Else
            // Minus One From currentImageCount
            currentImageCount--;
            // Call Function sliderController();
            sliderController();

        };
    };

    // Next Image Function
    function nextImage() {
        // If The currentImageCount Is imagesAreaImages.length
        if (currentImageCount === imagesAreaImages.length) {
            return false;
        } else { // Else
            // Plus One To currentImageCount
            currentImageCount++;
            // Call Function sliderController();
            sliderController();
        };
    };

    // Create Pagination Spans [Circls] Function
    (function createPaginationSpans() {
        // Loop On All The Images Slider
        for (var i = 0; i < imagesAreaImages.length; i++) {
            // Create Span 
            let paginationSpan = document.createElement('span');
            // Append The Span
            paginationArea.appendChild(paginationSpan)
        };
    })();

    // Slider Controler Function
    (sliderController = function() {
        // Get All The pagination Spans
        let paginationCircls = document.querySelectorAll('.pagination-area span');

        // Call Remore All Active Class Function
        removeAllActive(paginationCircls);

        // Call Remore Active Button Function
        activeButton();

        // The currentImageCount Minus One
        let currentImageMinusOne = currentImageCount - 1;

        // Set Active Class On Current Pagination
        paginationCircls[currentImageMinusOne].classList.add('active');

        // Move The images Area First Image
        imagesAreaFirstImage.style.marginLeft = `-${600 * currentImageMinusOne}px`;
        console.log(600 * currentImageMinusOne);
    })();

    // Remove All Active Class Function
    function removeAllActive(targetElement) {
        for (var i = 0; i < targetElement.length; i++) {
            targetElement[i].classList.remove('active');
        };
    };

    // Check Active Button Function
    function activeButton() {
        // If The Current Image Count Equle 1
        currentImageCount === 1 ?
            // Hide The Previous Button
            previousBtn.classList.add('disabled') :
            // Else: Show The Previous Button
            previousBtn.classList.remove('disabled');

        // If The Current Image Count Equle imagesAreaImages.length
        currentImageCount === imagesAreaImages.length ?
            // Hide The Next Button
            nextBtn.classList.add('disabled') :
            // Else: Show The Next Button
            nextBtn.classList.remove('disabled');
    };

    // Move Slider Image Every 3 Second 
    setInterval(() => {
        // If The Current Image Count Not Equle imagesAreaImages.length
        if (currentImageCount != imagesAreaImages.length) {
            // Plus One
            currentImageCount++;
            // Call Function sliderController();
            sliderController();
        } else { // else
            // Make currentImageCount Equle 1
            currentImageCount = 1;
            // Call Function sliderController();
            sliderController();
        };
    }, 3000);

    // :)
</script>