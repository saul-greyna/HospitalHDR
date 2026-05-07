function initializeCounters() {
    const counters = document.querySelectorAll('[data-target-value]');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;

            const element = entry.target;
            const target = Number(element.dataset.targetValue);

            let current = 0;

            const increment = Math.ceil(target / 30);

            const timer = setInterval(() => {
                current += increment;

                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }

                element.textContent = current + '+';
            }, 16);

            observer.unobserve(element);
        });
    }, {
        threshold: 0.1
    });

    counters.forEach(counter => observer.observe(counter));
}

document.addEventListener('DOMContentLoaded', initializeCounters);