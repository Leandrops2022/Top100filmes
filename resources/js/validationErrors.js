const erros = document.querySelectorAll('.mensagem-erro');

if (erros) {
    setTimeout(() => {
        erros.forEach(erro => {
            erro.textContent = "";
        });
    }, 3000);
}