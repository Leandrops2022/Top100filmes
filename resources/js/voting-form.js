const estrelas = document.querySelectorAll('.estrela');
const mensagemSucesso = document.querySelector('#mensagem');
const botaoVotar = document.querySelector('#botao-submit');

if (botaoVotar) {
    botaoVotar.disabled = true;
}

estrelas.forEach(estrela => {
    estrela.addEventListener('click', (event) => {
        const estrelaSelecionada = event.currentTarget;
        const notaEstrelaSelecionada = parseInt(estrelaSelecionada.dataset.value);
        estrelas.forEach(estrela => {
            const notaEstrela = parseInt(estrela.dataset.value);

            if (notaEstrela <= notaEstrelaSelecionada) {
                estrela.classList.add('estrela-amarela');
            } else {
                estrela.classList.remove('estrela-amarela');
            }

            if (botaoVotar && notaAnterior != notaEstrelaSelecionada) {
                botaoVotar.disabled = false;
                botaoVotar.classList.remove('botao-desativado');
            }
        });
    })
});

const removerMensagem = (elemento) => {
    elemento.addEventListener('animationend', () => {
        elemento.remove();
    })
}

if (mensagemSucesso) {
    removerMensagem(mensagemSucesso);
    mensagemSucesso.style.animation = 'fadeout 7s linear';
}

