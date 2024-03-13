<x-Layout :filmes="$filmes" :minilista="$minilista" :sugestoes1="$sugestoes1" :sugestoes2="$sugestoes2">
    @vite('resources/css/minilista.scss')

    @section('titulo', $minilista->titulo)
    @section('description', $minilista->metaDescription)

    <div class="div-container-lista">
        <x-sugestao-conteudo :sugestoesconteudo="$sugestoes1" />
        <div class="conteudo-lista">
            <div class="imagem-capa-minilista">
                <img src="{{ asset($minilista->imagem) }}" alt="{{ $minilista->alt_imagem }}" width="1500px"
                    height="1000px">
                <span>{{ $minilista->fonte_imagem }}</span>
            </div>
            <div class="textos-intro-lista">
                <div class="flex flex-col">
                    <h1>{{ $minilista->titulo }}</h1>
                    <h2>{{ $minilista->subtitulo }}</h2>
                </div>

                {!! $minilista->texto !!}

            </div>


            <div class="div-mini-cards">
                @php
                    $indice = count($filmes) + 1;
                @endphp

                @foreach ($filmes as $filme)
                    @php
                        $indice = $indice - 1;
                        $dynamicVariableName = 'texto_' . $indice;
                    @endphp

                    <x-MiniCardFilme :filme="$filme" :ranking="$indice" />

                    @if (isset($minilista->$dynamicVariableName))
                        <div class="mb-20">
                            <p>
                                {{ $minilista->$dynamicVariableName }}
                            </p>
                        </div>
                    @endif
                @endforeach

            </div>

        </div>
        <x-sugestao-conteudo :sugestoesconteudo="$sugestoes2" />
    </div>
    <div id="disqus_thread"></div>
    <script>
        var disqus_config = function() {
            this.page.url = "<?php echo URL::current(); ?>";
            this.page.identifier = "<?php echo $minilista->slug; ?>"

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
