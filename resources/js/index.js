const gridWrappers = document.querySelectorAll('.grid-wrapper');

const observador = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && window.innerWidth <= 880) {
            const wrapper = entry.target;
            const titulo = wrapper.querySelector('h2');
            titulo.style.animation = 'neon 3s infinite alternate';
        }
    }, { threshold: 1 })
})

gridWrappers.forEach(wrapper => {
    observador.observe(wrapper);
    const card = wrapper.querySelector('.grid-item');

    card.addEventListener('mouseenter', () => {
        const titulo = wrapper.querySelector('h2');
        titulo.style.animation = 'neon 3s infinite alternate';
    })

    card.addEventListener('mouseleave', () => {
        const titulo = wrapper.querySelector('h2');
        titulo.style.animation = 'none';
    })
})




