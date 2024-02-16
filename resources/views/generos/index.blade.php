<x-Layout :items="$items">
    @vite('resources/css/generos.scss')


    @section('titulo', 'Explore nossos tops 100')
    @section('description',
        'Se é diversão o que você busca, com certeza irá gostar desses tops que preparamos para
        você!
        Organizamos as seções por gênero, para facilitar a sua escolha! E aí, você está no clima
        de ação? quem sabe um romance te aqueça o coração? talvez tudo o que voce precise agora seja um
        bom musical? Seja qual for o seu momento, temos tops para todos os gostos!
        Escolha uma seção e veja o ranking dos melhores filmes agora!')

        <div class="apresentacao">
            <h1 data-top100="index">Diversão para todos gostos!</h1>
            <h2>
                Explore os gêneros disponíveis
            </h2>
            <p>
                Se é diversão o que você busca, com certeza irá gostar desses tops que preparamos para
                você!
                Organizamos as seções por gênero, para facilitar a sua escolha! E aí, você está no clima
                de ação? quem sabe um romance te aqueça o coração? talvez tudo o que voce precise agora seja um
                bom musical? Seja qual for o seu momento, temos tops para todos os gostos!
                Escolha uma seção e veja o ranking dos melhores filmes agora!
            </p>
        </div>
        <div class="ad-box"></div>
        <div class="grid-filmes">

            @foreach ($items as $item)
                <div class="grid-wrapper">
                    <h2 class="titulo-card">{{ $item['tituloCard'] }}</h2>
                    <a href="{{ route('top100', ['genre' => $item['rota']]) }}">
                        <div class="grid-item">

                            <picture class="card-img">

                                <source type="image/webp"
                                    srcset="{{ asset('/assets/imagens_generos/' . $item['nomeImagem'] . '.webp') }}"
                                    alt="imagem-card-{{ $item['nomeImagem'] }}" id="card-img-{{ $item['nomeImagem'] }}">
                                <source type="image/jpeg"
                                    srcset="{{ asset('/assets/imagens_generos/' . $item['nomeImagem'] . '.jpg') }}"
                                    alt="imagem-card-{{ $item['nomeImagem'] }}" id="card-img-{{ $item['nomeImagem'] }}">
                                <img src="{{ asset('/assets/imagens_generos/' . $item['nomeImagem'] . '.jpg') }}"
                                    alt="imagem-card-{{ $item['nomeImagem'] }}" id="card-img-{{ $item['nomeImagem'] }}">

                            </picture>

                        </div>
                    </a>
                </div>
            @endforeach

        </div>

        @vite('resources/js/app.js')
        @vite('resources/js/generos.js')
    </x-Layout>
