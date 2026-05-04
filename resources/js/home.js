function initializeCounters() {
    const counters = document.querySelectorAll('[data-target-value]');
    const animatedCounters = new Set();

    const animateCounter = (element) => {
        if (animatedCounters.has(element)) return;
        animatedCounters.add(element);

        const targetValue = parseInt(element.getAttribute('data-target-value'), 10);
        const duration = 1100;
        const startTime = Date.now();
        const startValue = 0;

        const updateCounter = () => {
            const elapsedTime = Date.now() - startTime;
            const progress = Math.min(elapsedTime / duration, 1);

            const easeOutQuad = 1 - Math.pow(1 - progress, 2);
            const currentValue = Math.floor(startValue + (targetValue - startValue) * easeOutQuad);

            element.textContent = currentValue + '+';

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            }
        };

        updateCounter();
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 1
    });

    counters.forEach((counter) => {
        observer.observe(counter);
    });
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', initializeCounters);
