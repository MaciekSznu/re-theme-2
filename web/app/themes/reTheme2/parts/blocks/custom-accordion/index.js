const $ = jQuery.noConflict();
const trigger = '.single-accordion__title';

const toggleAccordion = (e) => {
    const el = $(e.target);
    const parent = el.parent();
    const elContent = parent.next();

    if (parent.hasClass('active')) {
        parent.removeClass('active');
        elContent.stop().slideUp(250);
    } else {
        parent.addClass('active');
        elContent.stop().slideDown(250);
    }
}

const initAccordion = () => {
    $(trigger).on('click', (e) => toggleAccordion(e));
};

const backendAccordionInit = () => {
    $(document).on('click', trigger, (e) => toggleAccordion(e));
}

initAccordion();
export { backendAccordionInit };

