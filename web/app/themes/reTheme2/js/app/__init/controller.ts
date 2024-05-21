/* eslint-disable @typescript-eslint/no-empty-function */
import { vhUnit } from '../__constants/vhUnit';
import { detectDevice } from '../__constants/detectDevice';
import { ScreenLock } from '../__constants/lock-screen';

// GLOBAL APP CONTROLLER
const controller = {
    init() {
        vhUnit();
        detectDevice();
    },
    loaded() {
        document.querySelector('body')?.classList.add('page-has-loaded');
    },
    resized() {
        vhUnit();
        ScreenLock.relock();
    },
    mouseUp(_e: Event) {},
    keyDown(_e: Event) {},
    scrolled(_e: Event) {
        if (ScreenLock.isLocked) jQuery(window).scrollTop(0); // iOS landscape bug
    },
};

export { controller };
