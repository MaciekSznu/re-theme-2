const accordionsScript = () => {
    const accordions = document.querySelectorAll('.accordion');

    if (accordions.length < 1) {
        return;
    }
    // get all accordions
    accordions.forEach((item) => {
        const trigger = item.querySelector('.accordion__trigger');

        // add click event for every accordion
        trigger && trigger.addEventListener('click', (e) => {
            const targetEl = e.currentTarget as HTMLElement;

            if (targetEl) {
                const currentAccordion = targetEl.closest('.accordion');

                // toggle on/off
                if (currentAccordion && currentAccordion.classList.contains('active')) {
                    currentAccordion.classList.remove('active');
                } else {
                    currentAccordion && currentAccordion.classList.add('active');
                }
            }
            
        });
    });
};

accordionsScript();
