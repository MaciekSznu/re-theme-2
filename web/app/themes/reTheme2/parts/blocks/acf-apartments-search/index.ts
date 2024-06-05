const apartmentsSearch = () => {
    const dotsWrapper = document.querySelector('.apartments-search__dots-wrapper');
    const dots = dotsWrapper && dotsWrapper.querySelectorAll('.apartments-search__dot');
    const searchModal = document.querySelector('.apartments-search__modal');

    if (!dots || !searchModal) {
        return;
    }

    dots.forEach((dot) => {
        dot.addEventListener('click', (e) => {
            const target = e.target as HTMLElement;
            const apStatus = target.dataset.apStatus ? target.dataset.apStatus : '';
            const apNumber = target.dataset.apNumber ? target.dataset.apNumber : '';
            const apFloorNumber = target.dataset.apFloorNumber ? target.dataset.apFloorNumber : '';
            const apRoomsNumber = target.dataset.apRoomsNumber ? target.dataset.apRoomsNumber : '';
            const apBathsNumber = target.dataset.apBathsNumber ? target.dataset.apBathsNumber : '';
            const apArea = target.dataset.apArea ? target.dataset.apArea : '';
            const apPrice = target.dataset.apPrice ? target.dataset.apPrice : '';
            const modalApStatus = searchModal.querySelector('[data-ap-status]');
            if (modalApStatus) {
                modalApStatus.innerHTML = apStatus.charAt(0).toUpperCase() + apStatus.slice(1);
            }
            const modalApNumber = searchModal.querySelector('[data-ap-number]');
            if (modalApNumber) {
                modalApNumber.innerHTML = apNumber;
            }
            const modalApFloorNumber = searchModal.querySelector('[data-ap-floor-number]');
            if (modalApFloorNumber) {
                modalApFloorNumber.innerHTML = apFloorNumber;
            }
            const modalApRoomsNumber = searchModal.querySelector('[data-ap-rooms-number]');
            if (modalApRoomsNumber) {
                modalApRoomsNumber.innerHTML = apRoomsNumber;
            }
            const modalApBathsNumber = searchModal.querySelector('[data-ap-baths-number]');
            if (modalApBathsNumber) {
                modalApBathsNumber.innerHTML = apBathsNumber;
            }
            const modalApArea = searchModal.querySelector('[data-ap-area]');
            if (modalApArea) {
                modalApArea.innerHTML = apArea;
            }const modalApPrice = searchModal.querySelector('[data-ap-price]');
            if (modalApPrice) {
                modalApPrice.innerHTML = apPrice;
            }
        });
    });
};

apartmentsSearch();
