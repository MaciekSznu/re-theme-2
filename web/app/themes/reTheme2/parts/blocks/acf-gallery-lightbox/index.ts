import { Slider } from '../../../js/lib/sliders';
import { ScreenLock } from '../../../js/app/__constants/lock-screen';

const $ = jQuery.noConflict();

export class LightboxGallery {
    block: Element;

    galleryLightbox: HTMLElement | null;

    lightboxTrigger: NodeListOf<Element>;

    lightboxTriggerClose: HTMLElement | null;

    constructor(block: Element) {
        this.block = block;
        this.galleryLightbox = block?.querySelector('.gallery-lightbox');
        this.lightboxTrigger = block?.querySelectorAll(
            '.gallery-lightbox-thumb'
        );
        this.lightboxTriggerClose = block?.querySelector(
            '.gallery-lightbox__close'
        );
        this.init();
    }

    init() {
		if (!this.block) {
			return;
		}
        this.initSlider();
        this.lightboxTrigger.forEach((item) => {
            item.addEventListener('click', (e) => this.openLightbox(e));
        });
        if (this.lightboxTriggerClose) {
            this.lightboxTriggerClose.addEventListener(
                'click',
                this.closeLightbox.bind(this)
            );
        }

        window.addEventListener('keydown', this.keyPressDispatcher.bind(this));
    }

    initSlider = () => {
        [...[document.querySelectorAll('.gallery-lightbox__slider')]].forEach(
            (block) => {
                return new Slider(block[0], {
                    fade: true,
                    slidesToShow: 1,
                });
            }
        );
    };

    openLightbox = (e: Event) => {
        e.preventDefault();
        const trigger = $(e.target as HTMLElement)?.closest(
            '.gallery-lightbox-thumb'
        );
        const hash = trigger?.attr('href');
        const slideNum = parseInt(String(hash?.slice(1)), 10);
        const lightboxWrapper = trigger
            ?.closest('.block-gallery-lightbox')
            ?.find('.gallery-lightbox');
        lightboxWrapper?.addClass('active');
        const lightboxSlider = lightboxWrapper?.find(
            '.gallery-lightbox__slider'
        );
        lightboxSlider?.slick('slickGoTo', slideNum, true);
        ScreenLock.lock();
    };

    closeLightbox() {
        this.galleryLightbox?.classList.remove('active');
        ScreenLock.unlock();
    }

    keyPressDispatcher(e: KeyboardEvent) {
        if (e.key === 'Escape') {
            this.galleryLightbox?.classList.remove('active');
        }
        ScreenLock.unlock();
    }
}

const initBlock = () => {
    [...[document.querySelectorAll('.block-gallery-lightbox')]].forEach(
        (block) => new LightboxGallery(block[0])
    );
};

initBlock();
