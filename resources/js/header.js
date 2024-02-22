// const divFormularioBusca = document.querySelector('#div-form');
// const botaoBuscar = document.querySelector('#botao-buscar');
// const barraDeBusca = document.querySelector('#barra-busca-filmes');
// const botaoFecharBusca = document.querySelector('#botao-fechar-busca');
// const formulario = document.querySelector('#form-busca');
const botaoFecharMenu = document.querySelector('#botao-fechar-menu');

const botaoMenu = document.querySelector('#menu-button');
const divMenu = document.querySelector('#menu');

// const mostrarBusca = () => {
//     divFormularioBusca.style.display = 'flex';
// }

// const fecharBusca = () => {
//     divFormularioBusca.style.display = 'none';
// }

// const isEmptyStr = (str) => {
//     return str.length === 0;
// }

// botaoBuscar.addEventListener('click', mostrarBusca);

// botaoFecharBusca.addEventListener('click', (event) => {
//     fecharBusca();
// });

export const mostraMenu = () => {
    divMenu.style.display = divMenu.style.display == 'flex' ? 'none' : 'flex';
};



export const escondeMenuResponsivo = () => {

    divMenu.style.display = 'none';

}

botaoMenu.addEventListener('click', mostraMenu);

botaoFecharMenu.addEventListener('click', escondeMenuResponsivo)

document.addEventListener('click', (event) => {
    if (!divMenu.contains(event.target) && !botaoMenu.contains(event.target)) {
        escondeMenuResponsivo();

    }
});
