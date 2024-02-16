<x-Layout :movieVote="$movieVote" :filme="$filme" :elenco="$elenco" :tap="$tap" :idLista="$idLista">

    @section('titulo', trim($filme->titulo_portugues))
    @section('description', $filme->metaDescription)


    @vite('resources/css/filme.scss')

    <div id="container"
        style="background-image: url({{ asset($filme->poster_mobile) }}); background-image: url({{ asset($filme->poster_fallback) }});">
        <div class="informacoes-filme">
            <div class="div-poster-filme">
                <div class="div-fundo-preto">
                    <div class="div-ranking-e-nota">
                        <h1 class="titulo-e-nota">
                            {{ $filme->titulo_portugues }} - {{ $filme->nota }}<span class="estrela">&#9733;</span>
                        </h1>
                        <h2 class="ano-duracao">({{ $filme->genero }})</h2>
                        <h3 class="texto-generos-filme">
                            {{ $filme->ano_lancamento }} - {{ $filme->duracao }}min
                        </h3>

                        @auth
                            @if ($filme->botaoAdicionar)
                                <button class="botao-adiciona-filme-na-lista" data-filme="{{ $filme->id }}">

                                    <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <g stroke-width="0" />

                                        <g stroke-linecap="round" stroke-linejoin="round" />

                                        <g>
                                            <rect width="24" height="24" fill="none" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M13 9C13 8.44772 12.5523 8 12 8C11.4477 8 11 8.44772 11 9V11H9C8.44772 11 8 11.4477 8 12C8 12.5523 8.44772 13 9 13H11V15C11 15.5523 11.4477 16 12 16C12.5523 16 13 15.5523 13 15V13H15C15.5523 13 16 12.5523 16 12C16 11.4477 15.5523 11 15 11H13V9ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12Z"
                                                fill="#EED63B" />
                                        </g>

                                    </svg>
                                </button>
                            @endif
                        @endauth
                    </div>

                    <div class="div-resumo">
                        <div class="resumo">{!! $filme->resumo_portugues !!}</div>
                    </div>
                    <div class="div-trailer">
                        @isset($filme->trailer)
                            <iframe width="560" height="315" src="{{ $filme->trailer }}" title="YouTube video player"
                                frameborder="0" allow="web-share" allowfullscreen></iframe>
                        @else
                            <h1>Sem trailer disponível</h1>
                        @endisset

                    </div>
                </div>
            </div>
            <x-voting-form :id="$filme->id" :movieVote="$movieVote" />

        </div>



        <h3 class="titulo-elenco">Elenco: </h3>
        <div class="elenco">

            {{-- elenco is an array here --}}
            @isset($elenco)
                @if (count($elenco) > 0)
                    @foreach ($elenco as $ator)
                        <a href="{{ route('detalhesAtor', $ator->slug) }}">

                            <div class="ator">
                                <div class="foto-ator">
                                    @if ($ator->foto or $ator->foto_fallback)
                                        <picture>
                                            <source type="image/webp" srcset="{{ asset($ator->foto) }}" class="foto-ator"
                                                id="foto-ator" alt="foto-ator-{{ $ator->nome }}">
                                            <source type="image/jpeg" srcset="{{ asset($ator->foto_fallback) }}"
                                                class="foto-ator" id="foto-ator" alt="foto-ator-{{ $ator->nome }}">
                                            <img src="{{ asset($ator->foto_fallback) }}"
                                                alt="foto-ator-{{ $ator->nome }}" class="foto-ator" id="foto-ator">
                                        </picture>
                                    @else
                                        <img src="{{ asset('assets/no-photo.png') }}" alt="ator-sem-imagem-cadastrada">
                                    @endif

                                </div>
                                <div class="nome-ator-e-personagem">
                                    <p>
                                        {{ $ator->nome }} - {{ $ator->personagem }}
                                    </p>
                                </div>
                            </div>

                        </a>
                    @endforeach
                @endif

            @endisset

            <script>
                const tap = @json($tap);
                const idLista = @json($idLista);
            </script>
        </div>
    </div>



    @vite('resources/js/filme.js')
    @vite('resources/js/app.js')

</x-Layout>
