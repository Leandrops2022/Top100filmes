const botaoReenviarEmailConfirmacao = document.querySelector('#botao-reenviar-email-confirmacao');

if (botaoReenviarEmailConfirmacao) {
    botaoReenviarEmailConfirmacao.addEventListener('click', () => {
        botaoReenviarEmailConfirmacao.textContent = 'Aguarde...'
    })
}