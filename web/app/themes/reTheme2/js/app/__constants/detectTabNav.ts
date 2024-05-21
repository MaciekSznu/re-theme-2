const detectTabNav = (e: KeyboardEvent) => {
    if (e.key === 'Tab') {
        document.querySelector('html')?.classList.add('user-tab-nav');

        window.removeEventListener('keydown', detectTabNav);
        // eslint-disable-next-line @typescript-eslint/no-use-before-define
        window.addEventListener('mousedown', detectMouseNav);
    }
}

const detectMouseNav = () => {
    document.querySelector('html')?.classList.remove('user-tab-nav');

    window.removeEventListener('mousedown', detectMouseNav);
    window.addEventListener('keydown', detectTabNav);
}

export { detectTabNav };