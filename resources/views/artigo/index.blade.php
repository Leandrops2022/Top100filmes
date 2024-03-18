<x-Layout :artigo="$artigo" :sugestoes1="$sugestoes1" :sugestoes2="$sugestoes2">
    @vite('resources/css/artigo.scss')
    @section('titulo', trim($artigo->titulo))
    @section('description', $artigo->metaDescription)

    <div class="container-superior">
        <x-sugestao-conteudo :sugestoesconteudo="$sugestoes1" />

        <div class="container-principal">

            <div class="capa-artigo">
                <img src="{{ asset($artigo->imagem_1) }}" alt="{{ $artigo->alt_imagem_1 }}" width="720px" height="405px">
                <p class="atribuicao">
                    @isset($artigo->fonte_imagem_1)
                        {{ $artigo->fonte_imagem_1 }}
                    @else
                        Divulgação
                    @endisset
                </p>
            </div>
            <div class="titulo-e-subtitulo">
                <h1>{{ $artigo->titulo }}</h1>
                <p class="data-postagem">(Postado em: {{ $artigo->criado_em }} Por {{ $artigo->assinatura }})</p>
                <h2>{{ $artigo->subtitulo }}</h2>
            </div>

            <div class="texto-artigo">


                {!! $artigo->texto !!}


            </div>

            @isset($artigo->trailer)
                <div class="container-trailer">
                    <iframe width="560" height="315" src="{{ $artigo->trailer }}" title="YouTube video player"
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
            this.page.identifier = "<?php echo $artigo->slug; ?>"

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

</x-Layout>
