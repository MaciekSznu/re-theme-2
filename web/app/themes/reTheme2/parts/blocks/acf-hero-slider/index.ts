import { Slider } from '../../../js/lib/sliders';

const initHeroSlider = () => {
    [...[document.querySelectorAll('.hero__slider-wrapper')]].forEach(
        (block) => {
            return new Slider(block[0], {
                autoplay: true,
                autoplaySpeed: 5000,
                speed: 1000,
                fade: true,
                arrows: false,
                dots: true,
                pauseOnHover: false,
            });
        }
    );
};

initHeroSlider();

if (window.acf) {
    window.acf.addAction(
        'render_block_preview/type=hero-slider',
        initHeroSlider
    );
}
