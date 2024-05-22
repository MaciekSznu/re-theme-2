import { Slider } from '../../../js/lib/sliders';

const initSliderGallery = () => {
    [...[document.querySelectorAll('.slider-gallery__slider-wrapper')]].forEach(
        (block) => {
            return new Slider(block[0], {
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 1000,
                dots: false,
                pauseOnHover: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                nextArrow: '<div class="next"></div>',
                prevArrow: '<div class="prev"></div>',
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                        },
                    },
                ],
            });
        }
    );
};

initSliderGallery();

if (window.acf) {
    window.acf.addAction(
        'render_block_preview/type=slider-gallery',
        initSliderGallery
    );
}
