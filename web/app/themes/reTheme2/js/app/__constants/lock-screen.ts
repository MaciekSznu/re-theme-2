/**
 * --------------------------------------------------------------------------
 * Lock screen
 * Function locking screen scrolling, e.g for modals, menus or other
 * --------------------------------------------------------------------------
 */

const $ = jQuery.noConflict();
// --------------------------------------------------------------------------
// Cache DOM
const $html = $('html');
const $body = $('body');
const $window = $(window);
let scrollTop = 0;
// --------------------------------------------------------------------------
// Functions
const ScreenLock = {
    isLocked: false,
    lock() {
        if (!this.isLocked) {
            this.isLocked = true;
            const windowHeight = window.innerHeight;
            scrollTop = $window.scrollTop() ?? 0;
            $html.css({
                height: windowHeight,
                overflow: 'hidden',
            });
            $body.css({
                height: `${windowHeight + scrollTop}px`,
                overflow: 'hidden',
                marginTop: `-${scrollTop}px`,
            });
        }
    },
    unlock() {
        if (this.isLocked) {
            this.isLocked = false;
            $html.css({
                height: '',
                overflow: '',
            });
            $body.css({
                height: '',
                overflow: '',
                marginTop: '',
            });
            $window.scrollTop(scrollTop);
        }
    },
    relock() {
        if (this.isLocked) {
            this.unlock();
            this.lock();
        }
    },
};

export { ScreenLock };
