const animatedNumbers = () => {
    const counters = document.querySelectorAll('.animated-numbers__item-value');

    if (!counters || counters.length < 1) {
        return;
    }

    let counterObserver = new IntersectionObserver(function (
        entries,
        observer
    ) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                let counter = entry.target;
                let target = parseInt(counter.innerHTML);
                let step = target / 200;
                let current = 0;
                let timer = setInterval(function () {
                    current += step;
                    counter.innerHTML = `Math.floor(current)`;
                    if (parseInt(counter.innerHTML) >= target) {
                        clearInterval(timer);
                    }
                }, 5);
                counterObserver.unobserve(counter);
            }
        });
    });

    counters.forEach(function (counter) {
        counterObserver.observe(counter);
    });
};

animatedNumbers();
