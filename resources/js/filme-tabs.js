import { showVideos, hideVideos } from "./videoSlider";

const otherVideosContainer = document.querySelector("#outros-videos");
const trailersContainer = document.querySelector("#trailers");
const otherVideos = otherVideosContainer.querySelectorAll('[data-content-frame]');
const trailers = trailersContainer.querySelectorAll('[data-content-frame');

const tabs = document.querySelectorAll('[data-tab-target]');
const tabContents = document.querySelectorAll('[data-tab-content]');

const numberOfSlides = window.innerWidth < 900 ? 1 : 3;

let currentIndex = numberOfSlides - 1;

const forwardClickHandler = (button) => {


  const contentContainer = button.parentNode;

  const videoFrames = [...contentContainer.querySelectorAll('[data-content-frame]')];
  const botaoVoltar = contentContainer.querySelector('[data-botao-voltar]');

  const videoFramesCount = videoFrames.length - 1


  currentIndex++;

  hideVideos(videoFrames);
  showVideos(videoFrames, currentIndex, botaoVoltar, numberOfSlides, videoFramesCount);

  if (currentIndex > numberOfSlides - 1) {
    botaoVoltar.style.display = 'flex';
  }

  if (currentIndex == videoFramesCount) {
    button.style.display = 'none';
  }



}

const backClickHandler = (botaoVoltar) => {
  const contentContainer = botaoVoltar.parentNode;
  const botaoAvancar = contentContainer.querySelector('[data-botao-avancar]');

  const videoFrames = [...contentContainer.querySelectorAll('[data-content-frame]')];
  const videoFramesCount = videoFrames.length - 1


  currentIndex--;
  hideVideos(videoFrames);
  showVideos(videoFrames, currentIndex, botaoVoltar, numberOfSlides, videoFramesCount);


  if (currentIndex == numberOfSlides - 1) {
    botaoVoltar.style.display = 'none';
  }

  botaoAvancar.style.display = 'flex';


}

const indexReset = () => {
  currentIndex = numberOfSlides - 1;
}

const goBackButtons = document.querySelectorAll('[data-botao-voltar]');
const goForwardButtons = document.querySelectorAll('[data-botao-avancar]');

for (let i = 0; i < numberOfSlides; i++) {
  if (otherVideos && otherVideos.length > i) {
    otherVideos[i].style.display = 'flex';
  }
  if (trailers && trailers.length > i) {
    trailers[i].style.display = 'flex';
  }
}

goBackButtons.forEach(goBackButton => {
  goBackButton.classList.remove('showing');
  goBackButton.addEventListener('click', () => backClickHandler(goBackButton));
})

goForwardButtons.forEach(goForwardButton => {
  goForwardButton.addEventListener('click', (evt) => forwardClickHandler(evt.target));
  const contentContainer = goForwardButton.parentNode;
  const videoFrames = contentContainer.querySelectorAll('[data-content-frame]');
  const videoFramesCount = videoFrames.length;
  if (currentIndex >= videoFramesCount - 1) {
    goForwardButton.style.display = 'none';
  }

})

tabs.forEach(tab => {

  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget);
    tabs.forEach(tab => {
      tab.classList.remove('active');
    })
    tabContents.forEach(tabContent => {
      tabContent.classList.remove('active');

    })

    tab.classList.add('active');
    target.classList.add('active');
    indexReset();




  })
});






















// functionando sem mudar os videos
// tabs.forEach(tab => {
//   tab.addEventListener('click', () => {
//     const target = document.querySelector(tab.dataset.tabTarget);
//     tabs.forEach(tab => {
//       tab.classList.remove('active');
//     })
//     tabContents.forEach(tabContent => {
//       tabContent.classList.remove('active');

//     })
//     tab.classList.add('active');
//     target.classList.add('active');

//   })
// });