<x-Layout :ator="$ator" :filmesEmQueAtuou="$filmesEmQueAtuou">
    @vite('resources/css/detalhesAtor.scss')

    @section('titulo', trim("Top 100 filmes - $ator->nome"))
    @section('description', 'Página de Informações sobre o ator / atriz')

    <div class="card-ator" id="informacao-ator">
        {{-- <div class="aviso-conteudo-em-ingles" id="aviso-conteudo-em-ingles">
            <h3>Aviso importante</h3>
            <p>
                Nós do top 100 filmes nos esforçamos para trazer o máximo de conteúdo em português para nossos usuários,
                no
                entanto, devido a imensa quantidade de atores registrados em nossa base de dados alguns textos
                podem acabar sendo apresentados em
                inglês.
                Caso esta página não esteja
                em português, pedimos que utilize a tradução automática por enquanto, indo no menu do navegador e
                clicando
                "traduzir esta página". Gostaríamos de pedir também que nos informe o nome do ator,
                ou de preferência o endereço da página em que você viu o conteúdo, através do nosso formulário de
                contato
                selecionando
                a opção reportar bug e assim que possível iremos disponibilizar o conteúdo em português. Agradecemos a
                sua
                compreensão ; )
            </p>
        </div> --}}

        <div class="informacoes-iniciais efeito-card">

            <div class="foto-ator">
                <picture alt="foto do ator {{ $ator->nome }}" id="foto-ator" class="foto-ator-img">
                    <source type="image/webp" srcset="{{ asset($ator->poster) }}" alt="foto do ator {{ $ator->nome }}">
                    <source type="image/jpeg" srcset="{{ asset($ator->imagem) }}"
                        alt="foto do ator {{ $ator->nome }}">
                    <img src="{{ asset($ator->imagem_fallback) }}" alt="foto do ator {{ $ator->nome }}">
                </picture>
            </div>

            <div class="textos-iniciais">

                <div class="nome-ator">
                    <h1 class="texto-nome text-yellow-50 text-left">{{ $ator->nome }}</h1>
                </div>

                <div class="nascimento">
                    <span class="text-yellow-50">Data de nascimento:</span>
                    <p class="texto-nascimento">
                        {{ $ator->nascimento }}
                    </p>

                </div>

                <div class="local-nascimento">
                    <span class="text-yellow-50">Local de nascimento:</span>
                    <p class="texto-local-nascimento">{{ $ator->local_nascimento }}</p>
                </div>

                @if ($ator->morte != '')
                    <div class="outras-info">
                        <span class="text-yellow-50">Data de falecimento:</span>
                        <p class="data-morte">
                            {{ $ator->morte }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
        <div class="biografia efeito-card">
            <h3 class="header-biografia text-yellow-50">Biografia</h3><br>
            {!! $ator->biografia !!}
        </div>
        <div class="filmes-em-que-atuou">
            <h4 class="text-yellow-50">Filmes em que atuou</h4>
            @if ($filmesEmQueAtuou->count() > 0)
                <ul>
                    @foreach ($filmesEmQueAtuou as $filme)
                        <li class="efeito-card">
                            <a href=" {{ route('detalhesFilme', ['slug' => $filme->slug]) }}">
                                <div class="dados-filme">
                                    <div class="div-poster">

                                        <picture>
                                            <source type="image/webp" srcset=" {{ asset($filme->poster_mobile) }} "
                                                alt="poster-do-filme-{{ $filme->titulo_portugues }} ">
                                            <source type="image/jpeg" srcset=" {{ asset($filme->poster_fallback) }} "
                                                alt="poster-do-filme-{{ $filme->titulo_portugues }} ">
                                            <img src=" {{ asset($filme->poster_fallback) }} "
                                                alt="poster-do-filme-{{ $filme->titulo_portugues }} ">
                                        </picture>

                                    </div>
                                    <div class="div-nome-filme">
                                        <div class="nome-nota text-yellow-50">
                                            <span>{{ $filme->titulo_portugues }} ({{ $filme->ano_lancamento }})
                                            </span>

                                            <div class="nota-filme">
                                                <span class="ml-1 text-yellow-50 "> -
                                                    {{ $filme->nota }}
                                                </span>
                                                <span class="text-yellow-300 text-2xl pb-1">&#9733;
                                                </span>
                                            </div>

                                        </div>
                                        <div class="div-personagem text-sm">
                                            <span>{{ $filme->personagem }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    {{-- @vite('resources/js/detalhesAtor.js') --}}

</x-Layout>
