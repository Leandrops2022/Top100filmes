@vite('resources/css/cardFilme.scss')
<div class="filme-item">

    @auth
        @if ($filme->botaoAdicionar)
            <button class="botao-adiciona-filme-na-lista" data-filme="{{ $filme->id }}">
                <img src="{{ asset('/assets/icones/plus.svg') }}"
                    alt="icone com sinal de mais para adicionar filme a lista do usuario" loading="lazy">
            </button>
        @endif
    @endauth
    <a href="{{ route('detalhesFilme', ['slug' => $filme->slug]) }}">
        <div class="container-todo-conteudo">
            <div class="filme-item-poster">
                <picture>

                    <source type="image/webp" srcset="{{ asset($filme->poster_mobile) }}"
                        alt="poster-filme-{{ $filme->titulo_portugues }}" loading="lazy">
                    <source type="image/jpeg" srcset="{{ asset($filme->poster_fallback) }}"
                        alt="poster-filme-{{ $filme->titulo_portugues }}" loading="lazy">

                    <img src="{{ asset($filme->poster_fallback) }}" alt="poster-filme-{{ $filme->titulo_portugues }}"
                        loading="lazy">


                </picture>
            </div>

            <div class="filme-item-textos">
                <div class="ranking-e-nota">
                    <h2>{{ $filme->rank }} - {{ $filme->nota }} <span class="estrela">&#9733;</span></h2>
                </div>
                <div class="titulo-ano-duracao">
                    <h3>{{ $filme->titulo_portugues }}<br>({{ $filme->ano_lancamento }} - {{ $filme->duracao }}min)
                    </h3>
                    <h5 class="hidden text-center self-auto mt-5 md:flex">{{ $filme->tagline }}</h5>
                </div>

                @isset($filme->notaUsuario)
                    <svg class="assistido" width="40px" height="40px" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" fill="none" loading="lazy"
                        alt="icone de v para marcar como assistido">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">
                            <path stroke="#6387CF" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                d="M17 5L8 15l-5-4" />
                        </g>

                    </svg>
                @endisset
            </div>
        </div>
    </a>
</div>
