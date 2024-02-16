
const gridWrappers = document.querySelectorAll('.grid-wrapper');

gridWrappers.forEach(wrapper => {
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



