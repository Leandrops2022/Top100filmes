

export const divMenu = document.querySelector('#menu');
export const windowWidth = window.innerWidth;
export const botaoSeta = document.querySelector('#arrow-button');
export const ancoraObservador = document.querySelector('.observer-botao-seta');
export const cookies = document.cookie;
export const botaoCookie = document.querySelector('#botao-cookie');
export const divAvisoCookies = document.querySelector('#aviso-cookies');
export const overlayLogin = document.querySelector('#overlay-login');
export const botaoLogin = document.querySelector('#botao-login');
export const botaoFecharLogin = document.querySelector('#botao-fechar-login');

const observadorBotaoSeta = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            botaoSeta.style.display = 'flex';
            escondeMenuResponsivo();
        } else {
            botaoSeta.style.display = 'none';
        }
    })
});

export const escondeMenuResponsivo = () => {
    if (windowWidth <= 960 && divMenu.style.display == 'flex') {
        divMenu.style.display = 'none';
    }
}

export const voltarTopo = () => {
    window.scrollTo(
        {
            top: 0,
            behavior: 'smooth'
        }
    );
};

export const mostrarBotaoSeta = () => {

    observadorBotaoSeta.observe(ancoraObservador);
};

export const fechaAvisoCookies = () => {
    defineCookie("concorda-com-cookies", "sim", 30);
    divAvisoCookies.style.display = 'none';
}

export const concordanciaCookies = () => {
    if (!cookies.includes('concorda-com-cookies')) {
        divAvisoCookies.style.display = 'flex';

        setTimeout(() => {
            defineCookie("concorda-com-cookies", "sim", 30);
        }, 7000);
    }
}

export const mudançaDoTamanhoDaTela = () => {

    if (window.innerWidth > 960) {
        divMenu.style.display = 'grid';
    } else {
        divMenu.style.display = 'none';
    }
}

export const mostraFormLogin = () => {
    document.body.style.overflowY = 'hidden';
    overlayLogin.style.display = 'flex';
}

export const fecharLogin = () => {
    overlayLogin.style.animation = 'slide-to-right linear 0.2s';
    overlayLogin.classList.add('fechar');
    document.body.style.overflowY = 'scroll';

}

export const fecharLoginClicandoForaDoForm = (event) => {
    const elementoClicado = event.target;
    if (elementoClicado === overlayLogin) {
        overlayLogin.style.animation = 'slide-to-right linear 0.2s';
        overlayLogin.classList.add('fechar');
        document.body.style.overflowY = 'scroll';
    }

}

export const adicionaEventos = () => {
    window.addEventListener('resize', mudançaDoTamanhoDaTela);
    botaoSeta.addEventListener('click', voltarTopo);
    botaoLogin.addEventListener('click', mostraFormLogin);
    botaoFecharLogin.addEventListener('click', fecharLogin);
    overlayLogin.addEventListener('click', (event) => fecharLoginClicandoForaDoForm(event));

    overlayLogin.addEventListener('animationend', () => {
        if (overlayLogin.classList.contains('fechar')) {
            overlayLogin.classList.remove('fechar');
            overlayLogin.style.display = 'none';
            overlayLogin.style.animation = 'slide-from-right linear 0.2s';

        }
    })

    botaoCookie.addEventListener('click', fechaAvisoCookies);
}

export const defineCookie = (nome, valor, dias, path = '/') => {
    const dataExpiracao = new Date();
    dataExpiracao.setDate(dataExpiracao.getDate() + dias);
    const conteudoCookie = encodeURIComponent(nome) + "=" + encodeURIComponent(valor) + ";expires=" + dataExpiracao.toUTCString() + `${ path }`;
    document.cookie = conteudoCookie;
}

adicionaEventos();
concordanciaCookies();
mostrarBotaoSeta();

// const okDesativacao = () => {
//     const overlayAdblock = document.querySelector('.overlay-adblock');
//     document.body.style.overflowY = 'scroll';
//     overlayAdblock.style.display = 'none';
// }

// const adblockDetectado = () => {

//     const overlayAdblock = document.createElement('div');
//     overlayAdblock.className = 'overlay-adblock';
//     overlayAdblock.style.display = 'flex';

//     document.body.append(overlayAdblock);
//     document.body.style.overflowY = 'hidden';

//     const caixaDialogoDesativacaoAdblock = document.createElement('div');
//     caixaDialogoDesativacaoAdblock.className = 'dialogo-desativacao-adblock';
//     caixaDialogoDesativacaoAdblock.innerText = 'Bem vindo(a) ao top 100 filmes! Nosso site precisa da sua ajuda. Nossa única fonte de renda vem da exibição de anúncios não invasivos, por favor desative seu adblock e ajude-nos a manter um conteúdo gratuito e de qualidade'

//     const botaoOkDesativarAdblock = document.createElement('button');
//     botaoOkDesativarAdblock.className = 'botao-desativacao-adblock';
//     botaoOkDesativarAdblock.innerText = 'Ok, irei desativar meu bloqueador de anúncios';
//     botaoOkDesativarAdblock.addEventListener('click', okDesativacao);
//     caixaDialogoDesativacaoAdblock.appendChild(botaoOkDesativarAdblock);

//     overlayAdblock.appendChild(caixaDialogoDesativacaoAdblock);

// }

