<x-Layout :destaques="$destaques" :minilistas="$minilistas">
    @vite('resources/css/index.scss')
    @section('description', 'Confira os melhores Artigos e notícias sobre filmes, séries e tudo que diz respeito à
        Hollywood')
        <div class="apresentacao">
            <h1 class="my-1 text-white">Últimas postagens</h1>
            <x-destaques :destaques="$destaques" />

            <div class="container">
                <a id="link-melhores" class="efeito-card" href="{{ route('showIndicadosOscar2024') }}">
                    <div id="indicados-oscar-2024">
                        <img src="{{ asset('assets/indicados-oscar-2024/oscars.webp') }}"
                            alt="vários oscars enfileirados em um pedestal" width="640px" height="360px">
                        <div class="legenda-melhores">
                            <h5>Saiu a lista oficial dos indicados ao Oscar 2024!!!</h5>
                        </div>
                    </div>
                </a>

                <a id="link-melhores" class="efeito-card" href="{{ route('melhoresFilmes2023') }}">
                    <div id="melhores-filmes-2023">
                        <img src="{{ asset('assets/melhores-do-ano/capaMelhores2023-2.webp') }}"
                            alt="foto com um troféu e vários elementos de festa ao redor">
                        <div class="legenda-melhores">
                            <h5>Confira nossa lista de Melhores filmes de 2023!!!</h5>
                        </div>
                    </div>
                </a>

                {{-- <div class="listas efeito-card">

                <div class="listas-wrapper">
                    <ul>
                        @foreach ($minilistas as $minilista)
                            <li>
                                <div class="lista-item">
                                    <div class="miniatura-lista">
                                        <img src="{{ $minilista->imagem_capa }}" alt="{{ $minilista->alt_imagem_capa }}"
                                            loading="lazy">
                                    </div>
                                    <a href="{{ route('minilista', ['slug' => $minilista->slug]) }}">
                                        <span>{{ $minilista->titulo }}</span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div> --}}
            </div>

        </div>

        <h2 id="secao-tops">
            Confira nossas listas!
        </h2>


        <div class="grid-filmes">
            @foreach ($minilistas as $minilista)
                <div class="grid-wrapper">
                    <a href="{{ route($minilista->rota, ['slug' => $minilista->slug]) }}">
                        <div class="grid-item">
                            <img src="{{ asset($minilista->imagem_capa) }}" alt="{{ $minilista->alt_imagem_capa }}"
                                class="card-img" id="card-img-acao-{{ $loop->index }}" loading="lazy">
                            <div class="titulo-lista">
                                <span>{{ $minilista->titulo }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            {{-- <div class="grid-wrapper">
            <h2 class="titulo-card">AÇÃO</h2>
            <a href="{{ route('top100', ['genre' => 'acao']) }}">
                <div class="grid-item">
                    <picture loading="lazy">

                        <source type="image/webp" srcset="{{ asset('/assets/imagens_generos/acao3.webp') }}"
                            alt="img-card-genero-acao" class="card-img" id="card-img-acao-1" loading="lazy">
                        <source type="image/jpeg" srcset="{{ asset('/assets/imagens_generos/acao3.jpg') }}"
                            alt="img-card-genero-acao" class="card-img" id="card-img-acao-1" loading="lazy">
                        <img src="{{ asset('/assets/imagens_generos/acao3.jpg') }}" alt="img-card-genero-acao"
                            class="card-img" id="card-img-acao-1" loading="lazy">

                    </picture>
                </div>
            </a>
        </div> --}}

            {{-- <div class="grid-wrapper">
            <h2 class="titulo-card">ROMANCE</h2>
            <a href="{{ route('top100', ['genre' => 'romance']) }}">
                <div class="grid-item">

                    <picture loading="lazy">
                        <source type="image/webp" srcset="{{ asset('/assets/imagens_generos/romance1.webp') }}"
                            alt="img-card-genero-romance" class="card-img" id="card-img-romance-1" loading="lazy">
                        <source type="image/jpeg" srcset="{{ asset('/assets/imagens_generos/romance1.jpg') }}"
                            alt="img-card-genero-romance" class="card-img" id="card-img-romance-1" loading="lazy">
                        <img src="{{ asset('/assets/imagens_generos/romance1.jpg') }}" alt="img-card-genero-romance"
                            class="card-img" id="card-img-romance-1" loading="lazy">
                    </picture>

                </div>
            </a>
        </div>

        <div class="grid-wrapper">
            <h2 class="titulo-card">COMÉDIA</h2>
            <a href="{{ route('top100', ['genre' => 'comedia']) }}">
                <div class="grid-item">

                    <picture>
                        <source type="image/webp" srcset="{{ asset('/assets/imagens_generos/comedia1.webp') }}"
                            alt="img-card-genero-comedia" class="card-img" id="card-img-comedia-1" loading="lazy">
                        <source type="image/jpeg" srcset="{{ asset('/assets/imagens_generos/comedia1.jpg') }}"
                            alt="img-card-genero-comedia" class="card-img" id="card-img-comedia-1" loading="lazy">
                        <img src="{{ asset('/assets/imagens_generos/comedia1.jpg') }}" alt="img-card-genero-comedia"
                            class="card-img" id="card-img-comedia-1" loading="lazy">
                    </picture>

                </div>
            </a>
        </div>

        <div class="grid-wrapper">
            <h2 class="titulo-card">FANTASIA</h2>
            <a href="{{ route('top100', ['genre' => 'fantasia']) }}">
                <div class="grid-item">

                    <picture id="card-img-fantasia-1" class="card-img" loading="lazy">
                        <source type="image/webp" srcset="{{ asset('/assets/imagens_generos/fantasia2.webp') }}"
                            class="card-img" id="card-img-fantasia-1" alt="img-card-genero-fantasia" loading="lazy">
                        <source type="image/jpeg" srcset="{{ asset('/assets/imagens_generos/fantasia2.jpg') }}"
                            class="card-img" id="card-img-fantasia-1" alt="img-card-genero-fantasia" loading="lazy">
                        <img src="/assets/imagens_generos/fantasia2.jpg" class="card-img"
                            alt="img-card-genero-fantasia" loading="lazy">
                    </picture>

                </div>
            </a>
        </div> --}}

            <a role="button" id="botao-explorar" href="{{ route('todasListas') }}">Veja mais listas...</a>
        </div>

        @vite('resources/js/app.js')
        {{-- @vite('resources/js/index.js') --}}

    </x-Layout>
