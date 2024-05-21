import throttle from 'lodash/throttle';
import { controller } from './app/__init/controller';
import { detectTabNav } from './app/__constants/detectTabNav';


let handled = false;
controller.init();

window.addEventListener('load', () => {
    controller.loaded();
});

window.addEventListener( 'resize', throttle( controller.resized, 100 ) );

window.addEventListener( 'scroll', throttle( controller.scrolled, 100 ), {
	passive: true,
} );

window.addEventListener('keydown', (e) => {
    detectTabNav(e);
    controller.keyDown(e);
});

const handleMouseAndTouchEvents = (e: Event) => {
    if (e.type === 'touchend') {
        handled = true;
        controller.mouseUp(e);
    } else if (e.type === 'mouseup' && !handled) {
        controller.mouseUp(e);
    } else {
        handled = false;
    }
};

document.addEventListener('mouseup', handleMouseAndTouchEvents);
document.addEventListener('touchend', handleMouseAndTouchEvents);
