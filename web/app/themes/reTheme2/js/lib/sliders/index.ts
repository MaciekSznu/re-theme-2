const $ = jQuery.noConflict();

window.slickSliders = [];
window.sliderBlockIDs = [];

export class Slider {
    selector: Element;

	args: { [key: string]: string | number | boolean };

	getDefaultSlickSettings: { [key: string]: string | number | boolean };

    constructor(selector: Element, args = {}) {
        this.selector = selector;
        this.args = args;
        this.getDefaultSlickSettings = {
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            speed: 600,
        };
        window.addEventListener('load', () => {
            this.init();
        });
    }

    getSlickSettings() {
        return { ...this.getDefaultSlickSettings, ...this.args };
    }

    init() {
        const sliderBlockID = $(this.selector).data('slider') || null;
        if (typeof $.fn.slick !== 'function') {
            console.info('slick is undefined');
            return;
        }


        if ($(this.selector).length > 0 && ! $( this.selector ).hasClass( 'slick-initialized' )) {
            const settings = this.getSlickSettings();
            const slider = $(this.selector).slick(settings);

            if (window.sliderBlockIDs.indexOf(sliderBlockID) === -1) {
                window.slickSliders.push(slider.slick('getSlick'));
                window.sliderBlockIDs.push(sliderBlockID);
            }

            $(this.selector).on('setPosition', () => {
                $(this.selector)
                    .find('figcaption')
                    .each((i, item) => {
                        const caption = $(item);
                        const width = caption
                            .closest('figure')
                            .find('img')
                            .width();
                        caption.css('max-width', width && width > 0 ? `${width}px` : '');
                    });
            });
        }
    }
}
