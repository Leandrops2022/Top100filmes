<x-Layout :noticias="$noticias">
    @vite('resources/css/noticias.scss')

    @section('titulo', trim('Top 100 filmes - notícias'))
    @section('description',
        trim('Confira nossas notícias sobre filmes, séries, atores, e tudo relacionado ao mundo do
        cinema'))

        <div class="container-noticias">
            <div class="confira-tcf efeito-card">
                <div class="logo-tcf">
                    <img src="{{ asset('assets/logotcfnoticias.png') }}" alt="logo TCF noticias">
                </div>
            </div>
            <div class="apresentacao-tcf">
                <p>Temos uma novidade! o TCF notícias agora faz parte do top100filmes!!!</p>
                <p>Como parte do nosso novo plano de ações, decidimos que era necessário uma maior integração
                    entre os conteúdos apresentados no TCF Notícias e o top100filmes, com isso optamos por trazer todo o
                    conteúdo de notícias de séries e filmes para cá. Esperamos que vocês curtam essa novidade, pois estamos
                    felizes em anunciar que de hoje em diante você poderá acompanhar as últimas notícias do mundo do cinema
                    e de suas séries e streamings favoritos aqui mesmo no top100filmes!!
                </p>
                <br>
                <h1>Confira as Últimas Notícias</h1>
                <div class="grid-noticias">
                    @foreach ($noticias as $noticia)
                        <a href="{{ route('noticia', ['slug' => $noticia->slug]) }}">
                            <div class="card-noticia">
                                <img src='{{ asset("$noticia->imagem_capa") }}' alt="">
                                <div class="legenda-noticia">
                                    <span>{{ $noticia->titulo }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
                <div class="container-paginacao">
                    {{ $noticias->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </x-Layout>
