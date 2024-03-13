@vite('resources/css/sugestaoConteudo.scss')
<div class="container" :sugestoesconteudo="$sugestoesconteudo">

    <h4>Veja também:</h4>
    <div class="lista-sugestoes">
        @foreach ($sugestoesconteudo as $sugestao)
            <a class="link"
                @if ($sugestao->rota == 'top100') href="{{ route('top100', ['genre' => $sugestao->slug]) }}" @endif
                href='{{ route($sugestao->rota, $sugestao->slug) }}'>

                <div class="sugestao-card">
                    <img src="{{ asset($sugestao->capa) }}" alt="{{ $sugestao->alt_capa }}">
                    <div class="titulo-sugestao">
                        <span>{{ $sugestao->titulo }}</span>
                    </div>

                </div>
            </a>
        @endforeach
    </div>

</div>
