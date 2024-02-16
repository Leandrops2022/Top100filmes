<x-Layout :destaques="$destaques">
    @vite('resources/css/artigos.scss')

    @section('titulo', trim('Top 100 filmes - artigos'))
    @section('description',
        trim('Confira nossos artigos sobre filmes, séries, atores, e tudo relacionado ao mundo do
        cinema'))

        <div class="container-destaques">
            <x-destaques :destaques="$destaques" />
        </div>
        <div class="container-paginacao">
            {{ $destaques->links('vendor.pagination.default') }}
        </div>
    </x-Layout>
