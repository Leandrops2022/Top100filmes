import axios from 'axios';

const listaUsuario = document.querySelector('#lista-usuario');
const quantidadeFilmes = document.querySelector('#quantidade-filmes');

export const removerFilme = (event, tap, id_lista) => {
    const botao = event.currentTarget;
    const filme = botao.dataset.filme;
    const idFilme = parseInt(filme);
    const idLista = parseInt(id_lista);
    const cardFilme = botao.parentNode;
    const listItem = cardFilme.parentNode;

    const finalTap = tap.split('|')[1];

    const data = {
        'id_lista': idLista,
        'id_filme': idFilme
    };

    const config = {
        headers: {
            'Authorization': `Bearer ${finalTap}`,
            'content-Type': 'application/json',
        }
    };

    axios.delete(`/api/removerFilme/${idFilme}`, config)
        .then(response => {
            if (response.status == 204) {
                listaUsuario.removeChild(listItem)
                let quantidade = parseInt(quantidadeFilmes.textContent) - 1;
                quantidadeFilmes.textContent = quantidade;

            }

        })
}