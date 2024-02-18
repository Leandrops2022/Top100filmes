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


            <div>
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

    @vite('resources/js/app.js')
    @vite('resources/js/top100.js')
    @vite('resources/js/adicionaFilmeNaListaDoUsuario.js')

</x-Layout>
