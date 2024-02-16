import axios from "axios";

if (tap) {
    const botoesAdicionaFilme = document.querySelectorAll('.botao-adiciona-filme-na-lista');
    const idLista = oQueAssistir;
    const listaInicial = new Set(listaDoUsuario);
    const novaLista = new Set(listaDoUsuario);
    const cardSalvarAlteracoes = document.querySelector('#card-salvar-alterações');
    const botaoConfirmar = document.querySelector('#botao-salvar-alteracoes-lista');
    const textoCardFlutuante = document.querySelector('#texto-card-salvar');
    const mensagemSucesso = "Alterações Salvas com Sucesso!";
    const mensagemErro = "Ocorreu um erro, tente novamente mais tarde.";
    const mensagemListasIguais = "Adicione filmes na lista para salvar";

    const config = {
        headers: {
            'Authorization': `Bearer ${ tap }`
        }
    };

    let data = {
        id_lista: idLista,
        lista: [...listaInicial]
    }

    const adicionarFilme = (event) => {

        cardSalvarAlteracoes.style.display = 'flex';
        const botao = event.currentTarget;
        const idFilme = botao.dataset.filme;

        novaLista.add(idFilme);

        botao.style.display = "none";
        botao.removeEventListener('click', adicionarFilme);

        if (novaLista.length == 100) {
            botoesAdicionaFilme.forEach(botao => {
                botao.style.display = "none";
                botao.removeEventListener('click', adicionarFilme);

            });
        }

        data.lista = [...novaLista];

    }

    botoesAdicionaFilme.forEach(botao => {
        botao.addEventListener('click', adicionarFilme);
    });
    const setarMensagem = (mensagem, tipo) => {
        const textoPadrao = textoCardFlutuante.textContent;
        textoCardFlutuante.classList.toggle(tipo);
        textoCardFlutuante.textContent = mensagem;
        botaoConfirmar.disabled = true;
        botaoConfirmar.classList.toggle('disabled');

        setTimeout(() => {
            textoCardFlutuante.classList.toggle(tipo);
            textoCardFlutuante.textContent = textoPadrao;
            botaoConfirmar.disabled = false;
            botaoConfirmar.classList.toggle('disabled');

        }, 7000);
    }

    const eqSet = (xS, yS) => xS.size === yS.size && [...xS].every((x) => yS.has(x));

    const salvarLista = () => {
        if (eqSet(novaLista, listaInicial)) {
            setarMensagem(mensagemListasIguais, 'erro')
            return
        }

        axios.post('/api/adicionaFilmeNaLista', data, config)
            .then(response => {
                if (response.status == 201) {
                    setarMensagem(mensagemSucesso, 'sucesso');
                } else {
                    setarMensagem(mensagemErro, 'erro');
                }
            })
            .catch(error => {
                setarMensagem(mensagemErro, 'erro');
            });
    }

    botaoConfirmar.addEventListener('click', salvarLista)

    // window.addEventListener('beforeunload', function (e) {

    //     e.preventDefault();
    //     e.returnValue = 'Mudanças';

    // });

}


