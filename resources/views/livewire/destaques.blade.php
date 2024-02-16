<div class="destaques">
    <ul class="area-destaques">
        @foreach ($destaques as $artigo)
            <li>
                <a href="">
                    <div class="artigo-destaque" wire:key="{{ $artigo->id }}">
                        <div class="capa-artigo">
                            <img src="{{ asset($artigo->imagem_1) }}" alt="">
                        </div>
                        <div class="titulo-artigo">
                            <h5 class="titulo-artigo">{{ $artigo->titulo }}</h5>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="paginacao-destaques">
        {{ $destaques->links('vendor.pagination.default') }}
    </div>

</div>


{{-- <div class="destaques">
    <ul class="area-destaques">
        @foreach ($destaques as $artigo)
            <li>
                <a href="#">
                    <div class="artigo-destaque" wire:key="{{ $artigo->id }}">
                        <div class="capa-artigo">
                            <img src="{{ asset($artigo->imagem_1) }}" alt="">
                        </div>
                        <div class="titulo-artigo">
                            <h5 class="titulo-artigo">{{ $artigo->titulo }}</h5>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="paginacao-destaques">
        {{ $destaques->links('vendor.pagination.default') }}
    </div>
</div> --}}
