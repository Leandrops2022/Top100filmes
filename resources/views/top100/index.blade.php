<x-Layout :filmes="$filmes" :textos="$textos" :tap="$tap" :filmesDaLista="$filmesDaLista" :oQueAssistir="$oQueAssistir" :metaDescription="$metaDescription"
    :sugestoes1="$sugestoes1" :sugestoes2="$sugestoes2">
    @vite('resources/css/top100.scss')

    @section('titulo', trim($textos->h1))
    @section('description', $metaDescription)


    <div class="grid-top-100">
        <x-sugestao-conteudo :sugestoesconteudo="$sugestoes1" />
        <div class="conteudo-top-100">

            <div class="textos-intro-top-100">
                @if ($filmes->onFirstPage())
                    <div class="imagem-capa">
                        <img src="{{ asset($textos->imagem_capa) }}" alt="">
                    </div>
                    <h1 id="nome-top-100">{{ $textos->h1 }}</h1>

                    {!! $textos->p !!}
                @endif

            </div>

            @auth
                <div class="card-salvar-alterações" id="card-salvar-alterações">
                    <p id="texto-card-salvar">Salvar alterações na lista?</p>
                    <button id="botao-salvar-alteracoes-lista">Confirmar</button>
                </div>

            @endauth
            @foreach ($filmes as $filme)
                <x-CardFilme :filme="$filme" :filmesDaLista="$filmesDaLista" />
            @endforeach

            <div id="container-paginacao">
                {{ $filmes->links('vendor.pagination.default') }}
            </div>
            <div id="container-paginacao-responsivo">
                {{ $filmes->links('vendor.pagination.tailwind') }}
            </div>
        </div>

        <script>
            const oQueAssistir = @json($oQueAssistir);
            const listaDoUsuario = @json($filmesDaLista);
            const tap = @json($tap);
        </script>
        <x-sugestao-conteudo :sugestoesconteudo="$sugestoes2" />

    </div>
    <div id="disqus_thread"></div>
    <script>
        var disqus_config = function() {
            this.page.url = "<?php echo URL::current(); ?>";
            this.page.identifier = "<?php echo $textos->h1; ?>"

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

    @vite('resources/js/app.js')
    @vite('resources/js/top100.js')
    @vite('resources/js/adicionaFilmeNaListaDoUsuario.js')

</x-Layout>
