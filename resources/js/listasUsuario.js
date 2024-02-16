import { removerFilme } from './removerFilmeDaLista';

const botoesRemover = document.querySelectorAll('.botao-remover');

botoesRemover.forEach(botao => botao.addEventListener('click', (event) => {
    removerFilme(event, tap, idLista);
}))

