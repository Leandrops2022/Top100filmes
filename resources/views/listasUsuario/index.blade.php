<x-Layout :listasDoUsuario="$listasDoUsuario" :filmesDaLista="$filmesDaLista" :apiToken="$apiToken">
    @vite('resources/css/listasUsuario.scss')

    <div class="container-listas">
        <h1>{{ $listasDoUsuario[0]->nome_da_lista }}</h1>
        <span class="quantidade-filmes" id="quantidade-filmes">{{ $filmesDaLista->count() }}</span>

        <div class="miniaturas-filmes">

            @if ($filmesDaLista->count() > 0)
                <x-lista-de-resultados :resultados="$filmesDaLista" />
            @else
                <h3 class="mt-20">Você ainda não adicionou filmes a lista</h3>
            @endif

        </div>
    </div>
    <script>
        const idLista = @json($listasDoUsuario[0]->id);
        const tap = @json($apiToken);
    </script>
    </div>
    @vite('resources/js/listasUsuario.js')

</x-Layout>
