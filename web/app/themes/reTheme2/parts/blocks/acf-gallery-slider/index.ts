import { Slider } from '../../../js/lib/sliders';

const initGallerySlider = () => {
    [...[document.querySelectorAll('.block-gallery-slider__wrapper')]].forEach(
        (block) => {
            return new Slider(block[0], {
                fade: false,
                slidesToShow: 3,
                variableWidth: true,
                centerMode: true,
                infinite: true,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                        },
                    },
                ],
            });
        }
    );
};

initGallerySlider();

if (window.acf) {
    window.acf.addAction(
        'render_block_preview/type=gallery-slider',
        initGallerySlider
    );
}
