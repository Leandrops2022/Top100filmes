import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        tailwindcss('./tailwind.config.js'),
        laravel({
            input: [
                'resources/css/oscar-2024.scss',
                'resources/css/melhoresDoAno.scss',
                'resources/js/noticia.mjs',
                'resources/src/App.tsx',
                'resources/css/quizes.scss',
                'resources/css/minilista.scss',
                'resources/css/artigo.scss',
                'resources/css/artigos.scss',
                'resources/css/destaques.scss',
                'resources/css/faq.scss',
                'resources/js/faq.js',
                'resources/js/verify-email.js',
                'resources/css/resultadosBusca.scss',
                'resources/css/404.scss',
                'resources/css/app.scss',
                'resources/js/layoutPadrao.js',
                'resources/js/app.js',
                'resources/css/cadastro.scss',
                'resources/css/contato.scss',
                'resources/css/detalhesAtor.scss',
                'resources/js/detalhesAtor.js',
                'resources/css/effect-coverflow.css',
                'resources/css/filme.scss',
                'resources/js/generos.js',
                'resources/css/generos.scss',
                'resources/js/index.js',
                'resources/css/index.scss',
                'resources/css/layoutpadrao.scss',
                'resources/css/quemSomos.scss',
                'resources/css/reset.css',
                'resources/css/swiper-bundle.min.css',
                'resources/js/swiper-bundle.js',
                'resources/css/swiper-vars.css',
                'resources/js/top100.js',
                'resources/css/top100.scss',
                'resources/css/voting-form.scss',
                'resources/js/voting-form.js',
                'resources/js/voting-form.js',
                'resources/js/profile.js',
                'resources/css/listasUsuario.scss',
                'resources/js/listasUsuario.js',
                'resources/css/validationErrors.scss',
                'resources/js/validationErrors.js',
                'resources/css/validationSuccess.scss',
                'resources/css/cardFilme.scss',
                'resources/js/adicionaFilmeNaListaDoUsuario.js',
                'resources/css/listaDeResultados.scss',
                'resources/js/removerFilmeDaLista.js',
                'resources/js/resultadosBusca.js',
                'resources/js/filme.js',
                'resources/js/header.js',
                'resources/css/header.scss',
                'resources/css/noticias.scss',
                'resources/css/noticia.scss',

            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
        react(),
    ],
    css: {
        modules: true, // Enable CSS modules
    },
});
