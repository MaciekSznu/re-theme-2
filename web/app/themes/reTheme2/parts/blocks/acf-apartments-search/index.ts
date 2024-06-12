const $ = jQuery.noConflict();
import 'ion-rangeslider';

const apartmentsSearch = () => {
    const dotsWrapper = document.querySelector(
        '.apartments-search__dots-wrapper'
    );
    const dots =
        dotsWrapper && dotsWrapper.querySelectorAll('.apartments-search__dot');
    const searchModal = document.querySelector('.apartments-search__modal');

    if (!dots || !searchModal) {
        return;
    }

    dots.forEach((dot) => {
        dot.addEventListener('click', (e) => {
            const target = e.target as HTMLElement;
            const apStatus = target.dataset.apStatus
                ? target.dataset.apStatus
                : '';
            const apNumber = target.dataset.apNumber
                ? target.dataset.apNumber
                : '';
            const apFloorNumber = target.dataset.apFloorNumber
                ? target.dataset.apFloorNumber
                : '';
            const apRoomsNumber = target.dataset.apRoomsNumber
                ? target.dataset.apRoomsNumber
                : '';
            const apBathsNumber = target.dataset.apBathsNumber
                ? target.dataset.apBathsNumber
                : '';
            const apArea = target.dataset.apArea ? target.dataset.apArea : '';
            const apPrice = target.dataset.apPrice
                ? target.dataset.apPrice
                : '';
            const apUrl = target.dataset.apUrl ? target.dataset.apUrl : '';
            const modalApStatus = searchModal.querySelector('[data-ap-status]');
            if (modalApStatus) {
                modalApStatus.innerHTML =
                    apStatus.charAt(0).toUpperCase() + apStatus.slice(1);
            }
            const modalApNumber = searchModal.querySelector('[data-ap-number]');
            if (modalApNumber) {
                modalApNumber.innerHTML = apNumber;
            }
            const modalApFloorNumber = searchModal.querySelector(
                '[data-ap-floor-number]'
            );
            if (modalApFloorNumber) {
                modalApFloorNumber.innerHTML = apFloorNumber;
            }
            const modalApRoomsNumber = searchModal.querySelector(
                '[data-ap-rooms-number]'
            );
            if (modalApRoomsNumber) {
                modalApRoomsNumber.innerHTML = apRoomsNumber;
            }
            const modalApBathsNumber = searchModal.querySelector(
                '[data-ap-baths-number]'
            );
            if (modalApBathsNumber) {
                modalApBathsNumber.innerHTML = apBathsNumber;
            }
            const modalApArea = searchModal.querySelector('[data-ap-area]');
            if (modalApArea) {
                modalApArea.innerHTML = apArea;
            }
            const modalApPrice = searchModal.querySelector('[data-ap-price]');
            if (modalApPrice) {
                modalApPrice.innerHTML = apPrice;
            }
            const modalApUrl =
                searchModal.querySelector<HTMLAnchorElement>('[data-ap-url]');
            if (modalApUrl) {
                modalApUrl.href = apUrl;
            }
        });
    });
};

apartmentsSearch();

const apartmentsTable = () => {
    const tableWrapper = document.querySelector(
        '.apartments-search__table-wrapper'
    );
    const tableRows =
        tableWrapper &&
        tableWrapper.querySelectorAll<HTMLElement>(
            '.apartments-search__table-row'
        );
    const tableFilters =
        tableWrapper &&
        document.querySelector('.apartments-search__table-filters');

    if (!tableRows || !tableFilters) {
        return;
    }

    const filterButtons = tableFilters.querySelectorAll<HTMLButtonElement>(
        'button.filter-button'
    );

    const activeFloors: string[] = [];
    const activeRooms: string[] = [];
    const activeStatuses: string[] = [];

    filterButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            if (button.dataset.apFloorNumber) {
                if (button.classList.contains('active')) {
                    const btnDataIndex = activeFloors.indexOf(
                        button.dataset.apFloorNumber
                    );
                    activeFloors.splice(btnDataIndex, 1);
                    if (activeFloors.length > 0) {
                        tableRows.forEach((row) => {
                            row.dataset.apFloorNumber ===
                            button.dataset.apFloorNumber
                                ? row.classList.add('floor-hidden')
                                : null;
                        });
                    } else {
                        tableRows.forEach((row) => {
                            row.classList.remove('floor-hidden');
                        });
                    }
                    button.classList.remove('active');
                } else {
                    activeFloors.push(button.dataset.apFloorNumber);
                    tableRows.forEach((row) => {
                        !activeFloors.includes(row.dataset.apFloorNumber)
                            ? row.classList.add('floor-hidden')
                            : row.classList.remove('floor-hidden');
                    });
                    button.classList.add('active');
                }
            }
            if (button.dataset.apRoomsNumber) {
                if (button.classList.contains('active')) {
                    const btnDataIndex = activeRooms.indexOf(
                        button.dataset.apRoomsNumber
                    );
                    activeRooms.splice(btnDataIndex, 1);
                    if (activeRooms.length > 0) {
                        tableRows.forEach((row) => {
                            row.dataset.apRoomsNumber ===
                            button.dataset.apRoomsNumber
                                ? row.classList.add('room-hidden')
                                : null;
                        });
                    } else {
                        tableRows.forEach((row) => {
                            row.classList.remove('room-hidden');
                        });
                    }
                    button.classList.remove('active');
                } else {
                    activeRooms.push(button.dataset.apRoomsNumber);
                    tableRows.forEach((row) => {
                        !activeRooms.includes(row.dataset.apRoomsNumber)
                            ? row.classList.add('room-hidden')
                            : row.classList.remove('room-hidden');
                    });
                    button.classList.add('active');
                }
            }
            if (button.dataset.apStatus) {
                if (button.classList.contains('active')) {
                    const btnDataIndex = activeStatuses.indexOf(
                        button.dataset.apStatus
                    );
                    activeStatuses.splice(btnDataIndex, 1);
                    if (activeStatuses.length > 0) {
                        tableRows.forEach((row) => {
                            row.dataset.apStatus === button.dataset.apStatus
                                ? row.classList.add('status-hidden')
                                : null;
                        });
                    } else {
                        tableRows.forEach((row) => {
                            row.classList.remove('status-hidden');
                        });
                    }
                    button.classList.remove('active');
                } else {
                    activeStatuses.push(button.dataset.apStatus);
                    tableRows.forEach((row) => {
                        !activeStatuses.includes(row.dataset.apStatus)
                            ? row.classList.add('status-hidden')
                            : row.classList.remove('status-hidden');
                    });
                    button.classList.add('active');
                }
            }
        });
    });

    $('#ion-area-slider').ionRangeSlider({
        onFinish: function (data) {
            tableRows.forEach((row) => {
                if (
                    row.dataset.apArea &&
                    (data.from > parseFloat(row.dataset.apArea) ||
                        data.to < parseFloat(row.dataset.apArea))
                ) {
                    row.classList.add('area-hidden');
                } else {
                    row.classList.remove('area-hidden');
                }
            });
        },
    });
    $('#ion-price-slider').ionRangeSlider({
        onFinish: function (data) {
            tableRows.forEach((row) => {
                if (
                    row.dataset.apPrice &&
                    (data.from > parseFloat(row.dataset.apPrice) ||
                        data.to < parseFloat(row.dataset.apPrice))
                ) {
                    row.classList.add('price-hidden');
                } else {
                    row.classList.remove('price-hidden');
                }
            });
        },
    });
};

apartmentsTable();
