@vite('resources/css/header.scss')
<header class="cabecalho">
    <nav class="barra-navegacao">

        <div class="area-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/TCFLogoSite.svg') }}" alt="logotipo">

            </a>
        </div>

        <div class="div-busca">
            <div class="div-form" id="div-form">
                <form action="{{ route('busca') }}" id="form-busca" method="GET">
                    @csrf
                    <input class="border-none focus:ring-0" type="search" id="barra-busca-filmes" name="busca"
                        placeholder="Digite algo para buscar">

                    <select class="seletor-busca" name="tipo_busca" id="tipo_busca" required>
                        <option value="filme">Filme</option>
                        <option value="ator">Ator/atriz</option>
                        <option value="artigo">Artigo</option>
                        <option value="lista">Listas</option>
                        <option value="noticia">Notícia</option>
                    </select>

                </form>
                <button id="botao-fechar-busca">X</button>
            </div>
            <button id="botao-buscar" type="button">
                <img src="{{ asset('assets/icones/search.svg') }}" alt="botao buscar com formato de lupa">
            </button>
        </div>

        <div class="area-links" id="menu">
            <button class="botao-fechar-menu" id="botao-fechar-menu">X</button>
            <ul class="lista-links">
                <li><a class="links" href="{{ route('home') }}">
                        <p>
                            <img class="icone-home" src="{{ asset('assets/icones/home.svg') }}" alt="icone de uma casa"
                                loading="lazy">
                            Home
                        </p>
                    </a>
                </li>
                <li><a class="links" href="{{ route('melhoresFilmes2023') }}">
                        <p>
                            <img class="icone-home" src="{{ asset('assets/icones/trophy.svg') }}"
                                alt="icone de um troféu" loading="lazy">
                            melhores de 2023
                        </p>
                    </a>
                </li>
                <li><a class="links" href="{{ route('mostrarQuizes') }}">
                        <p>
                            <img class="icone-home" src="{{ asset('assets/icones/test.svg') }}" alt="icone de uma prova"
                                loading="lazy">
                            Quiz
                        </p>
                    </a>
                </li>
                <li><a class="links" href="{{ route('noticias') }}">
                        <p>
                            <img class="icone-noticias" src="{{ asset('assets/icones/noticias.svg') }}"
                                alt="icone de uma casa" loading="lazy">
                            Notícias
                        </p>
                    </a>
                </li>
                <li><a class="links" href="{{ route('artigos') }}">
                        <p>
                            <img class="icone-home" src="{{ asset('assets/icones/newspaper.svg') }}"
                                alt="icone de artigos de jornal" loading="lazy">
                            Artigos
                        </p>
                    </a></li>
                <li><a class="links" href="{{ route('generos') }}">
                        <p>
                            <img class="icone-home" src="{{ asset('assets/icones/porgenero.svg') }}"
                                alt="duas mascaras simbolizando generos de filmes" loading="lazy">
                            Por categoria
                        </p>
                    </a></li>
                <li><a class="links" role="button" href="{{ route('top100', 'geral') }}">
                        <p>
                            <img class="icone-home" src="{{ asset('assets/icones/top100.svg') }}" alt="ícone de troféu"
                                loading="lazy">
                            100 melhores
                        </p>
                    </a></li>
                <li><a class="links" href="{{ route('quemSomos') }}">
                        <p>
                            <img class="icone-home" src="{{ asset('assets/icones/quemsomos.svg') }}"
                                alt="ícone com 3 bonecos" loading="lazy">
                            Quem somos
                        </p>
                    </a></li>
                <li class="links">
                    <button class="botao-login" id="botao-login">
                        @auth
                            @if (session('fotoPerfil'))
                                <div class="foto-usuario">
                                    <img src="{{ session('fotoPerfil') }}" alt="ícone de uma porta">
                                </div>
                                <p class="titulo-botao ml-3">
                                    Minha conta
                                </p>
                            @elseif(auth()->user()->profile_photo_path)
                                <div class="foto-usuario">
                                    <img src="{{ auth()->user()->profile_photo_path }}" alt="">
                                </div>
                                <p class="titulo-botao ml-3">
                                    Minha conta
                                </p>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="30 -1000 900 960"
                                    width="33" height="33">
                                    <path
                                        d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.814-195Q422-450 382.5-489.686q-39.5-39.686-39.5-97.5t39.686-97.314q39.686-39.5 97.5-39.5t97.314 39.686q39.5 39.686 39.5 97.5T577.314-489.5q-39.686 39.5-97.5 39.5Zm.654 370Q398-80 325-111.5q-73-31.5-127.5-86t-86-127.266Q80-397.532 80-480.266T111.5-635.5q31.5-72.5 86-127t127.266-86q72.766-31.5 155.5-31.5T635.5-848.5q72.5 31.5 127 86t86 127.032q31.5 72.532 31.5 155T848.5-325q-31.5 73-86 127.5t-127.032 86q-72.532 31.5-155 31.5ZM480-140q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z" />
                                </svg>

                                <p class="titulo-botao">
                                    Minha conta
                                </p>
                            @endif
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="30 -1000 900 960"
                                width="33" height="33">
                                <path
                                    d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.814-195Q422-450 382.5-489.686q-39.5-39.686-39.5-97.5t39.686-97.314q39.686-39.5 97.5-39.5t97.314 39.686q39.5 39.686 39.5 97.5T577.314-489.5q-39.686 39.5-97.5 39.5Zm.654 370Q398-80 325-111.5q-73-31.5-127.5-86t-86-127.266Q80-397.532 80-480.266T111.5-635.5q31.5-72.5 86-127t127.266-86q72.766-31.5 155.5-31.5T635.5-848.5q72.5 31.5 127 86t86 127.032q31.5 72.532 31.5 155T848.5-325q-31.5 73-86 127.5t-127.032 86q-72.532 31.5-155 31.5ZM480-140q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z" />
                            </svg>
                            <p>
                                <img class="icone-entrar" src="{{ asset('assets/icones/entrar.svg') }}" alt="">

                                Entrar
                            </p>
                        @endauth



                    </button>
                </li>
            </ul>
        </div>

        <div class="div-botao-menu">
            <button type="button" id="menu-button">
                <img src="{{ asset('assets/icones/menu_responsivo.svg') }}" id="menu-icon"
                    alt="icone-menu-responsivo" loading="lazy">
            </button>
        </div>

    </nav>
    @vite('resources/js/header.js')
</header>
