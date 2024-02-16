import axios from "axios";

const botoesAdicionar = document.querySelectorAll('.botao-adiciona-filme-na-lista');


const adicionarFilme = (event) => {
    const botao = event.currentTarget;
    const idFilme = botao.dataset.filme;
    const filmeArray = [];
    filmeArray.push(idFilme);

    const data = {
        'id_lista': idLista,
        'lista': filmeArray,
    }

    const config = {
        headers: {
            "Authorization": `Bearer ${tap}`
        }
    }

    axios.post('api/adicionaFilmeNaLista', data, config)
        .then(response => {
            if (response.status = 201) {
                botao.style.display = 'none';
            }
        })
}

botoesAdicionar.forEach(botao => botao.addEventListener('click', (event) => adicionarFilme(event)));

