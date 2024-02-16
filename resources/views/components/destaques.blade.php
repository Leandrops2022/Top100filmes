@vite('resources/css/destaques.scss')
<div class="destaques" :destaques="$destaques">
    <ul class="area-destaques">
        @foreach ($destaques as $artigo)
            <li id="0" class="item-artigo mt-8">
                <a href="{{ route($artigo->rota, ['slug' => $artigo->slug]) }}">
                    <div class="artigo-destaque">
                        <div class="capa-artigo">
                            <img @isset($artigo->capa) src="{{ asset($artigo->capa) }}"@else src="{{ asset($artigo->imagem_capa) }}"@endisset
                                alt="{{ $artigo->alt_capa }}" class="capa-destaque" width="480" height="270">
                            <div class="tag">
                                <span>{{ $artigo->tag }}</span>
                            </div>
                        </div>
                        {{-- <div class="data-postagem">
                            <p class="postato-em">postado em: {{ $artigo->criado_em }} </p>
                        </div --}}
                        <div class="titulo-artigo">
                            <span class="titulo-artigo-texto">{{ $artigo->titulo }}</span>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>

</div>
