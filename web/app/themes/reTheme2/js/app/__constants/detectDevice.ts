function isTouchDevice() {
    return 'ontouchstart' in window || navigator.maxTouchPoints;
}

function detectDevice(){
    if (isTouchDevice()) {
        document.querySelector('html')?.classList.add('touch-device');
    }
}

export { detectDevice };