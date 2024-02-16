
const containers = document.querySelectorAll('.filme-item');

const observerFilme = new IntersectionObserver(function (entries) {
  entries.forEach(function (entry) {
    if (entry.isIntersecting) {

      entry.target.classList.add('item-visible');
    } else {
      entry.target.classList.remove('item-visible');
    }
  });
});

containers.forEach(container => {
  observerFilme.observe(container);
})

