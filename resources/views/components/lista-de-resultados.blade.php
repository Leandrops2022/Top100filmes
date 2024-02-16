@vite('resources/css/listaDeResultados.scss')
<div class="div-lista-filmes">
    <ul id="lista-usuario">
        @foreach ($resultados as $elemento)
            <li>
                <div class="container-card">
                    <a href="{{ route('detalhesFilme', ['slug' => $elemento->slug]) }}">
                        <div class="info-filme-busca efeito-card" id="{{ $elemento->titulo_portugues }}">
                            <div class="poster-filme-busca">
                                <picture>
                                    <source type="image/webp" srcset="{{ asset($elemento->poster_mobile) }}"
                                        alt="poster-{{ $elemento->titulo_portugues }}">
                                    <source type="image/jpeg" srcset="{{ asset($elemento->poster_fallback) }}"
                                        alt="poster-{{ $elemento->titulo_portugues }}">
                                    <img src="{{ asset($elemento->poster_fallback) }}"
                                        alt="poster-{{ $elemento->titulo_portugues }}">
                                </picture>

                            </div>

                            <div class="nome-filme">
                                <h2 class="nota-filme">
                                    {{ $elemento->nota }}<span> &#9733;</span>
                                </h2>
                                <span>
                                    {{ $elemento->titulo_portugues }}
                                </span>
                                <span>
                                    ({{ $elemento->ano_lancamento }})
                                </span>

                            </div>

                        </div>
                    </a>
                    <button class="botao-remover" data-filme="{{ $elemento->id }}">-</button>
                </div>
            </li>
        @endforeach
    </ul>

</div>
