<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="index, follow">

    <title name="titulo">@yield('titulo', 'Top 100 Filmes - Artigos, listas, e muito mais')</title>
    <meta name="description" content=
        "@yield('description', 'Confira os melhores Artigos e notícias sobre filmes, séries e tudo que diz respeito à Hollywood')">

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/android-chrome-192x192.png">
    <link rel="manifest" href="/assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="/assets/favicons/safari-pinned-tab.svg" color="#000000">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#000000">



    @vite(['resources/css/layoutpadrao.scss', 'resources/js/layoutPadrao.js'])

    @viteReactRefresh


</head>

<body>

    <x-Header />
    <div class="aviso-cookies" id="aviso-cookies">
        <p>
            O Top100filmes utiliza cookies e tecnologias similares para melhorar a experiência do usuário em nosso site.
            Ao continuar navegando no site você concorda com a nossa <a target="_blank"
                href="{{ route('policy.show') }}" role="button" class="abre-politica">Política
                de
                Privacidade</a>
        </p>
        <button id="botao-cookie">Ok</button>
    </div>

    <x-FormLogin />

    <div class="observer-botao-seta"></div>

    <main class="principal" id="principal">

        <div class="area-inicial_div">

            <div class="mensagens">
                <x-validation-success />
                <x-validation-errors class="erros" />
            </div>
            <div class="area-inicial">

                <button class="arrow-button" id="arrow-button">
                    <img src="/assets/icones/circle-arrow-up-solid.svg" alt="icone-flexa-cima">
                </button>
                {{ $slot }}
            </div>

        </div>

        <x-Footer />

    </main>

</body>

</html>
