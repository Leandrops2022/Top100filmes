<x-Layout :noticia="$noticia">
    @vite('resources/css/noticia.scss')

    @section('titulo', trim($noticia->titulo))
    @section('description', $noticia->metaDescription)

    <div class="container-principal">
        <div class="capa-noticia">
            <img src="{{ asset($noticia->imagem_1) }}" alt="{{ $noticia->alt_imagem_1 }}" width="480px" height="270px"
                loading="lazy">
            <p class="atribuicao">
                @isset($noticia->fonte_imagem_1)
                    {{ $noticia->fonte_imagem_1 }}
                @else
                    Divulgação
                @endisset
            </p>
        </div>

        <div class="titulo-e-subtitulo">
            <h1>{{ $noticia->titulo }}</h1>
            <p class="data-postagem">(Postado em: {{ $noticia->criado_em }} por {{ $noticia->assinatura }})</p>
            <h2>{{ $noticia->subtitulo }}</h2>

        </div>

        <div class="texto-noticia">
            {!! $noticia->texto !!}
        </div>


        @isset($noticia->trailer)
            <div class="container-trailer">
                <iframe width="560" height="315" src="{{ $noticia->trailer }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        @endisset


    </div>
    {{-- @vite('resources/js/noticia.mjs') --}}
</x-Layout>
