const $ = jQuery.noConflict();

const video = {
    init() {
        $('.iframe-wrapper__overlay').on('click', this.hideOverlay);
    },
    hideOverlay(e) {
        e.preventDefault();
        const parent = $(this).parents('.iframe-wrapper');

        parent.find('iframe')[0].src = parent.find('iframe')[0].dataset.src;


        if (!parent.hasClass('wistia')) {
            parent.find('iframe')[0].src += '&autoplay=1&loop=1&rel=0&wmode=transparent';
        } else {
            parent.find('iframe')[0].src = `https://fast.wistia.net/embed/iframe/${parent.data('video-id')}?autoplay=1`;
        }

        $(this).delay(300).fadeOut();
    },
};


video.init();