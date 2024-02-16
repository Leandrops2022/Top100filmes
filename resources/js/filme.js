import axios from "axios";
const botaoAdicionar = document.querySelector('.botao-adiciona-filme-na-lista');


const adicionarFilme = () => {
    const idFilme = parseInt(botaoAdicionar.dataset.filme);
    const lista = parseInt(idLista);

    const config = {
        headers: {
            'Authorization': `Bearer ${tap}`
        }
    };

    const data = {
        id_lista: lista,
        lista: [idFilme]
    };
    axios.post('/api/adicionaFilmeNaLista', data, config)
        .then(response => {
            if (response.status == 201) {
                botaoAdicionar.style.display = 'none';
            }
        })
}

if (botaoAdicionar) {
    botaoAdicionar.addEventListener('click', adicionarFilme)
}