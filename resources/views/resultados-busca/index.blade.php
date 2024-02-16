<x-Layout :resultados="$resultados" :tap="$tap" :idLista="$idLista">

    @vite('resources/css/resultadosBusca.scss')

    <div class="div-lista-filmes">

        @if ($resultados->count() > 0)
            <ul>
                @foreach ($resultados as $elemento)
                    <li>
                        {{-- @if ($elemento->tag == 'Artigo' || $elemento->tag == 'Listas' || $elemento->tag == 'Filme') --}}
                        @if (in_array($elemento->tag, ['Artigo', 'Listas', 'Filme', 'Notícia', 'Ator/Atriz']))
                            <a href="{{ route($elemento->rota, ['slug' => $elemento->slug]) }}">
                                <div class="info-filme-busca efeito-card" id="{{ $elemento->nome }}">
                                    <div class="poster-filme-busca">
                                        <picture>
                                            <source type="image/webp" srcset="{{ asset($elemento->imagem) }}"
                                                alt="poster-{{ $elemento->nome }}">
                                            <source type="image/jpeg" srcset="{{ asset($elemento->imagem_fallback) }}"
                                                alt="poster-{{ $elemento->nome }}">
                                            <img src="{{ asset($elemento->imagem_fallback) }}"
                                                alt="poster-{{ $elemento->nome }}">
                                        </picture>

                                    </div>
                                    <div class="nome-filme">
                                        <p>
                                            {{ $elemento->nome }} @if ($elemento->tag == 'Filme')
                                                ({{ $elemento->data }})
                                            @endif
                                        </p>
                                    </div>
                                    <div class="tag-elemento"> {{ $elemento->tag }}</div>
                                </div>
                            </a>
                        @else
                            <a href="{{ route($elemento->rota, ['id' => $elemento->id]) }}">
                                <div class="info-filme-busca efeito-card" id="{{ $elemento->nome }}">
                                    <div class="poster-filme-busca">
                                        <picture>
                                            <source type="image/webp" srcset="{{ asset($elemento->imagem) }}"
                                                alt="poster-{{ $elemento->nome }}">
                                            <source type="image/jpeg" srcset="{{ asset($elemento->imagem_fallback) }}"
                                                alt="poster-{{ $elemento->nome }}">
                                            <img src="{{ asset($elemento->imagem_fallback) }}"
                                                alt="poster-{{ $elemento->nome }}">
                                        </picture>

                                    </div>
                                    <div class="nome-filme">
                                        <p>
                                            {{ $elemento->nome }} @if ($elemento->tag == 'Filme')
                                                ({{ $elemento->data }})
                                            @endif
                                        </p>
                                    </div>
                                    <div class="tag-elemento"> {{ $elemento->tag }}</div>
                                </div>
                            </a>
                        @endif
                        @auth
                            @if ($elemento->tag === 'Filme' && $elemento->botaoAdicionar)
                                <button class="botao-adiciona-filme-na-lista" data-filme="{{ $elemento->id }}">

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
                    </li>
                @endforeach
            </ul>
        @else
            <h3>Nada Encontrado</h3>
        @endif
        <script>
            const tap = @json($tap);
            const idLista = @json($idLista);
        </script>
    </div>
    <div class="div-container-paginacao">
        {{ $resultados->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>
    @vite('resources/js/resultadosBusca.js')
</x-Layout>
