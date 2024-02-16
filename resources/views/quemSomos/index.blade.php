<x-Layout>
    @vite('resources/css/quemSomos.scss')

    @section('titulo', 'Quem somos')
    @section('description',
        'Somos um casal de cinéfilos, apaixonados por bons momentos e, claro, por bons
        filmes. A ideia deste espaço surgiu em um daqueles dias em que nos vimos diante de uma sequência
        desanimadora de filmes ruins. Foi então que percebemos o quão desafiador pode ser encontrar indicações de
        filmes realmente diferenciados e de alta qualidade.')

        <div class='div-quem-somos'>
            <h1>Quem somos</h1>
            <p>Somos um casal de cinéfilos, apaixonados por bons momentos e, claro, por bons
                filmes. A ideia deste espaço surgiu em um daqueles dias em que nos vimos diante de uma sequência
                desanimadora de filmes ruins. Foi então que percebemos o quão desafiador pode ser encontrar indicações de
                filmes realmente diferenciados e de alta qualidade.
            </p>

            <p>
                Nosso objetivo é mudar essa realidade e tornar sua jornada cinematográfica mais empolgante e gratificante.
                Aqui, você encontrará uma cuidadosa seleção dos melhores filmes, aqueles que deixaram marcas na história do
                cinema e nos corações dos espectadores. Desde clássicos icônicos até pérolas escondidas, buscamos
                proporcionar a você uma experiência única e cativante.
            </p>

            <p>
                Somos movidos pela paixão pelo cinema e pela vontade de compartilhar com você, nosso querido visitante, essa
                mesma paixão. Navegue em nosso site, descubra novos horizontes cinematográficos e deixe-se envolver pela
                magia das telonas. Junte-se a nós nessa jornada e embarque em uma emocionante viagem através das histórias,
                personagens e emoções que só o mundo do cinema pode oferecer. Seja bem-vindo(a) à nossa comunidade de
                amantes do cinema, e que juntos possamos criar memórias inesquecíveis através de filmes que nos tocam
                profundamente.
            </p>

            <div class="apresentacao-pessoas">
                <div class="pessoa-1">
                    <div class="div-imagem">
                        <img src="{{ asset('assets/imagens-quem-somos/3a90e9aa.webp') }}" alt="">
                    </div>
                    <h5>Leandro Soares</h5>
                    <div class="div-resumo">
                        <p class="resumo">
                            Desenvolvedor fullstack, gosta de bons filmes e jogos de pc, principalmente os de RPG, mas abre
                            uma
                            exceção
                            para stardew valley pois gosta de desestressar colhendo mirtilos em sua fazenda.
                        </p>
                    </div>
                </div>
                <div class="pessoa-1">
                    <div class="div-imagem">
                        <img src="{{ asset('assets/imagens-quem-somos/sf.jpeg') }}" alt="">
                    </div>
                    <h5>Camila Amaral</h5>
                    <div class="div-resumo">
                        {{-- <p class="resumo">
                        Historiadora
                    </p> --}}
                    </div>
                </div>
            </div>

        </div>

        @vite('resources/js/app.js')
    </x-Layout>
