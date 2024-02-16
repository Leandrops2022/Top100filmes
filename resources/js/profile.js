
export const windowWidth = window.innerWidth;
export const botaoSeta = document.querySelector('#arrow-button');
export const ancoraObservador = document.querySelector('.observer-botao-seta');
export const cookies = document.cookie;
export const botaoCookie = document.querySelector('#botao-cookie');
export const divAvisoCookies = document.querySelector('#aviso-cookies');

const observadorBotaoSeta = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            botaoSeta.style.display = 'flex';

        } else {
            botaoSeta.style.display = 'none';
        }
    })
});

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

export const adicionaEventos = () => {
    botaoSeta.addEventListener('click', voltarTopo);
    botaoCookie.addEventListener('click', fechaAvisoCookies);
}

export const defineCookie = (nome, valor, dias, path = '/') => {
    const dataExpiracao = new Date();
    dataExpiracao.setDate(dataExpiracao.getDate() + dias);
    const conteudoCookie = encodeURIComponent(nome) + "=" + encodeURIComponent(valor) + ";expires=" + dataExpiracao.toUTCString() + `${path}`;
    document.cookie = conteudoCookie;
}

adicionaEventos();
concordanciaCookies();
mostrarBotaoSeta();

