<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Descubra uma seleção épica dos 100 melhores filmes de todos os tempos, 
        com clássicos atemporais e emocionantes lançamentos. Prepare a pipoca e mergulhe nessa experiência 
        cinematográfica inesquecível.">
    <meta name="robôs" content="index, follow">

    <title>Top 100 Filmes</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/android-chrome-512x512.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/android-chrome-192x192.png">
    <link rel="manifest" href="/assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="/assets/favicons/safari-pinned-tab.svg" color="#000000">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#000000">

    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <link rel="canonical" href="https://www.top100filmes.com.br" />

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="aviso-cookies" id="aviso-cookies">
        <p>
            O Top100filmes utiliza cookies e tecnologias similares para melhorar a experiência do usuário em nosso site.
            Ao continuar navegando no site você concorda com a nossa <a href="#" role="button"
                class="abre-politica">Política
                de
                Privacidade</a>
        </p>
        <button id="botao-cookie">Ok</button>
    </div>

    <!-- Page Heading -->
    @if (isset($header))
        <header>
            @livewire('navigation-menu')
        </header>
    @endif

    <div class="observer-botao-seta"></div>

    <!-- Page Content -->
    <main class="principal">

        <button class="arrow-button" id="arrow-button">
            <img src="/assets/icones/circle-arrow-up-solid.svg" alt="icone-flexa-cima">
        </button>

        {{ $slot }}

        <x-Footer />
    </main>


    @stack('modals')

    @livewireScripts
</body>

</html>
