<x-Layout :filmes="$filmes" :minilista="$minilista">
    @vite('resources/css/minilista.scss')

    @section('titulo', $minilista->titulo)
    @section('description', $minilista->metaDescription)


    <div class="div-container-lista">
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
                @foreach ($filmes as $filme)
                    @php
                        $indice = 10 - $loop->index;
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

    </div>

    @vite('resources/js/app.js')
    @vite('resources/js/top100.js')
    @vite('resources/js/adicionaFilmeNaListaDoUsuario.js')

</x-Layout>
