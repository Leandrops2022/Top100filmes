

export const showVideos = (videoFrames, currentIndex, botaoVoltar, numberOfSlides, maxIndex) => {
  const slidesIndexesToShow = numberOfSlides - 1;


  if (numberOfSlides === 1) {
    if (currentIndex == 0) {
      botaoVoltar.classList.remove('showing');
    }

    if (currentIndex <= maxIndex || currentIndex >= 0) {

      videoFrames[currentIndex].style.display = 'flex';
    }
  } else {
    for (let i = currentIndex; i >= currentIndex - slidesIndexesToShow; i--) {

      videoFrames[i].style.display = 'flex';
      if (i == 0) {
        botaoVoltar.classList.remove('showing');
        break;
      }

    }
  }


}

export const hideVideos = (videoFrames) => {
  videoFrames.forEach(frame => {
    frame.style.display = 'none';
  })
}


// const videoSlider = (containerVideos, indiceAtual, limit) => {

//   const botaoAvancar = containerVideos.querySelector('[data-botao-avancar]');
//   const botaoVoltar = containerVideos.querySelector('[data-botao-voltar]');

//   const indiceLimite = limit - 1;

//   const videoFrames = containerVideos.querySelectorAll("[data-content-frame]");

//   const videosArray = [...videoFrames];

//   loopToAddActiveClass(videosArray, indiceAtual, limit);

//   botaoAvancar.addEventListener('click', () => {

//     removeActiveClassFromAllVideos(videosArray);

//     if (indiceAtual < indiceLimite) {
//       indiceAtual++;
//       loopToAddActiveClass(videosArray, indiceAtual, limit);

//     }

//     if (!botaoVoltar.classList.contains('showing')) {
//       botaoVoltar.classList.add('showing');
//     }

//     indiceAtual < indiceLimite ? "" : botaoAvancar.classList.remove('showing');

//   });

//   botaoVoltar.addEventListener('click', () => {

//     // aqui vai dar erro
//     removeActiveClassFromAllVideos(videosArray);

//     if (indiceAtual > indiceLimite) {
//       indiceAtual--;
//       loopToAddActiveClass(videoFrames, indiceAtual, limit);
//     }

//     if (!botaoAvancar.classList.contains('showing')) {
//       botaoAvancar.classList.add('showing');
//     }


//     if (indiceAtual == limit - 1) {
//       botaoVoltar.classList.remove('showing');
//       return;
//     }

//   });

// }



