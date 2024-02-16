const titulosDasPerguntas = document.querySelectorAll('h4');

titulosDasPerguntas.forEach(titulo => {
    titulo.addEventListener('click', (event) => {
        const pergunta = event.currentTarget;
        const resposta = document.querySelector(`#resposta-${pergunta.id}`);
        resposta.style.display = resposta.style.display == 'block' ? 'none' : 'block';

    })
});