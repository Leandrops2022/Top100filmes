@vite('resources/css/voting-form.scss')
@auth
    <form action="{{ route('cadastrarVoto', $id) }}" method="POST" id="formulario-votacao">
        @csrf
        <div class="nota-usuario-atual">
            <span>Sua nota:
                @if ($movieVote)
                    {{ $movieVote[0]->nota }}
                @else
                    você ainda não votou nesse filme
                @endif
            </span>
        </div>
        <div class="star-rating">
            @if ($movieVote)
                @for ($i = 1; $i <= 10; $i++)
                    <label for="nota{{ $i }}"
                        class="estrela {{ $i <= $movieVote[0]->nota ? 'estrela-amarela' : '' }}"
                        data-value="{{ $i }}">&#9733</label>
                    <input type="radio" name="nota" value="{{ $i }}" class="radio-nota"
                        id="nota{{ $i }}" {{ $i == $movieVote[0]->nota ? 'checked' : '' }}>
                @endfor
            @else
                @for ($i = 1; $i <= 10; $i++)
                    <label for="nota{{ $i }}" class="estrela" data-value="{{ $i }}">&#9733</label>
                    <input type="radio" name="nota" value="{{ $i }}" class="radio-nota"
                        id="nota{{ $i }}" {{ $i == 1 ? 'checked' : '' }}>
                @endfor
            @endif
        </div>

        @if ($movieVote)
            <button class="botao-desativado " type="submit" id="botao-submit"
                title="Altere seu voto para liberar o botão">Atualizar voto</button>
        @else
            <button class="botao-desativado " type="submit" id="botao-submit"
                title="clique nas estrelas para liberar o botao">Votar</button>
        @endif

        <script>
            const notaAnterior = @json($movieVote[0]->nota ?? null);
        </script>
    </form>
@endauth

@guest
    <div id="formulario-votacao-deslogado">
        <div class="star-rating-deslogado">
            @for ($i = 1; $i <= 10; $i++)
                <input type="radio" name="nota{{ $i }}" value="1" class="radio-nota">
                <label for="nota{{ $id }}" class="estrela-deslogado" data-value="1">&#9733</label>
            @endfor
        </div>
        <div id="div-mensagem-deslogado">Faça login para votar</div>
    </div>
@endguest
@vite('resources/js/voting-form.js');
