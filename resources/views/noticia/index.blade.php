<x-Layout :noticia="$noticia" :sugestoes1="$sugestoes1" :sugestoes2="$sugestoes2">
    @vite('resources/css/noticia.scss')

    @section('titulo', trim($noticia->titulo))
    @section('description', $noticia->metaDescription)

    <div class="container-principal">
        <x-sugestao-conteudo :sugestoesconteudo="$sugestoes1" />
        <div class="noticia">

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
        <x-sugestao-conteudo :sugestoesconteudo="$sugestoes2" />
    </div>

    <div id="disqus_thread"></div>
    <script>
        var disqus_config = function() {
            this.page.url = "<?php echo URL::current(); ?>";
            this.page.identifier = "<?php echo $noticia->slug; ?>"

        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://top100filmes.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>

    {{-- @vite('resources/js/noticia.mjs') --}}
</x-Layout>
