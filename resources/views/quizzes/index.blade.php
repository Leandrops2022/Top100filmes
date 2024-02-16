<x-Layout>
    @vite('resources/css/quizes.scss')

    @section('titulo', 'Top 100 filmes - Quiz')
    @section('description', 'Divirta-se com nossa seção de quiz sobre cinema!')

    <div class="container-quizes">
        <a href="{{ route('mostrarQuiz', ['slug' => 'velozesEFuriosos']) }}">
            <div class="card-quiz">
                <img h-270 w-480 src="{{ asset('assets/capas-quizes/velozesEFuriosos.webp') }}"
                    alt="imagem em formato de x com um grupo de pessoas e prédios ao fundo">
                <span>Quem você seria no universo de Velozes e Furiosos? Faça o teste e descubra</span>
            </div>
        </a>
    </div>
</x-Layout>
