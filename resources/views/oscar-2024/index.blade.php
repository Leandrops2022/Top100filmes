<x-Layout>
    @vite('resources/css/oscar-2024.scss')

    @section('titulo', trim('Saiu a lista oficial dos indicados ao Oscar!!!'))
    @section('description',
        " A temporada de premiações está em pleno andamento, e a Academia de Artes e Ciências Cinematográficas de
        Hollywood acaba de anunciar os indicados para o aguardado Oscar 2024...")

        <div class="container-principal">
            <div class="capa">
                <img src="{{ asset('assets/indicados-oscar-2024/oscars.webp') }}"
                    alt="Estatuetas do Oscar enfileiradas em um pedestal">
                <span>Getty images</span>
            </div>

            <div class="textos">
                <h1>Saiu a lista oficial dos indicados ao Oscar!!!</h1>
                <span>(postado em 23/01/2024 por Leandro Soares)</span>
                <br>

                <h2>E para a surpresa de ninguém, todos os indicados já eram conhecidos</h2>
                <br>
                <p>
                    A temporada de premiações está em pleno andamento, e a Academia de Artes e Ciências Cinematográficas de
                    Hollywood acaba de anunciar os indicados para o aguardado Oscar 2024. A transmissão ao vivo, comandada
                    pelos carismáticos Zazie Beetz e Jack Quaid, revelou uma lista repleta de surpresas, emoções e muita
                    competição.
                </p>
                <br>
                <h2>"Oppenheimer" - Líder em Indicações</h2>
                <br>
                <p>Em um feito impressionante, "Oppenheimer" conquistou o título de líder supremo, arrebatando 13
                    indicações. O filme nos leva de volta à Segunda Guerra Mundial, explorando a história da criação da
                    bomba atômica e destacando J. Robert Oppenheimer como peça central dessa narrativa impactante. </p>
                <br>

                <h2>Nolan e Sua Grande Produção Cinematográfica</h2>
                <br>
                <img src="{{ asset('assets/indicados-oscar-2024/oppenheimer.webp') }}"
                    alt="ator cyllian murphy com cachimbo na mão olhando para frente">
                <span style="text-align: left">Divulgação</span>
                <br>
                <p>
                    O renomado diretor Christopher Nolan não ficou para trás, com sua grande produção cinematográfica
                    acumulando indicações em várias categorias. Sua mais recente criação recebeu reconhecimento nas
                    categorias de melhor filme, direção, roteiro, trilha sonora original e atuações estelares de Cillian
                    Murphy, Robert Downey Jr. e Emily Blunt. Será que Nolan levará para casa a estatueta dourada este ano?
                </p>

                <br>

                <h2>Greta Gerwig e o Surpreendente "Barbie"</h2>
                <img src="{{ asset('assets/indicados-oscar-2024/barbie.webp') }}" alt="barbie e ken em um carro rosa">
                <span style="text-align: left">Divulgação</span>
                <p>A diretora Greta Gerwig não apenas trouxe vida à icônica boneca, mas também conquistou o coração da
                    Academia, acumulando oito indicações para "Barbie". O filme não só disputa na categoria de melhor filme,
                    mas também traz nomes de peso como Ryan Gosling e America Ferreira, concorrendo como melhor ator
                    coadjuvante e melhor atriz coadjuvante, respectivamente. A trilha sonora, peça fundamental, também
                    recebeu indicações: What Was I Made For?, de Billie Eilish, e I’m Just Ken, interpretada por Ryan
                    Gosling, concorrem a melhor canção.</p>
                <br>

                <h2>Martin Scorsese com o excelente “Assassinos da Lua das Flores"</h2>
                <img src="{{ asset('assets/indicados-oscar-2024/assassinos.webp') }}"
                    alt="poster do filme assassinos das luas das flores">
                <span style="text-align: left">Divulgação</span>
                <p>
                    Os "Assassinos da Lua das Flores" de Martin Scorsese não ficaram para trás, acumulando 10 indicações e
                    consolidando ainda mais a reputação do renomado diretor. Destaque especial para Lily Gladstone, que se
                    tornou a primeira indígena norte-americana a ser indicada como melhor atriz, marcando um momento
                    histórico na premiação.
                </p>
                <br>

                <h2>Yorgos Lanthimos surpreende com "Pobres Criaturas"</h2>
                <p>Surpreendendo ao desbancar o sucesso de bilheteria "Barbie", "Pobres Criaturas" de Yorgos Lanthimos
                    recebeu 11 indicações. Estrelado por Emma Stone, o filme não apenas brilhou no Oscar, mas também
                    conquistou o Globo de Ouro. Uma jornada única que mistura humor negro, drama e uma pitada de horror
                    vitoriano.
                </p>
                <br>

                <h2>Além da Fronteira: "A Sociedade da Neve"</h2>
                <p>O cinema internacional também teve seu lugar ao sol, com o filme do diretor espanhol J.A. Bayona, "A
                    Sociedade da Neve", indicado como melhor filme internacional. A história emocionante da equipe de rúgbi
                    uruguaia, perdida nas montanhas após um acidente aéreo, promete cativar o público e os votantes da
                    Academia.

                    A contagem regressiva para a grande noite do cinema começa. Quem levará para casa a estatueta dourada? A
                    resposta está a apenas algumas semanas de distância: a premiação acontece em 10 de março. Preparem-se
                    para a emoção, a elegância e as surpresas que o Oscar 2024 nos reserva!
                </p>
                <br>
                <p>
                    Confira abaixo a lista dos indicados
                </p>

                <br>
                <div class="indicados">
                    <h2>Melhor filme</h2>
                    <div class="filmes-indicados">
                        <p>Oppenheimer</p>
                        <p> American Fiction</p>
                        <p>Anatomia de uma queda</p>
                        <p>Barbie</p>
                        <p> Os rejeitados</p>
                        <p>Assassinos da Lua das Flores</p>
                        <p> Maestro</p>
                        <p>Vidas Passadas</p>
                        <p> Pobres Criaturas</p>
                        <p>Zona de interesse</p>
                    </div>
                    <br>

                    <h2> Melhor atriz</h2>
                    <div class="filmes-indicados">
                        <p>Lily Gladstone - Assassinos da Lua das Flores</p>
                        <p>Sandra Hüller - Anatomia de uma queda</p>
                        <p>Carey Mulligan - Maestro</p>
                        <p>Emma Stone - Pobres criaturas</p>
                        <p>Annette Bening – Nyad</p>

                    </div>
                    <br>
                    <h2>Melhor ator</h2>
                    <div class="filmes-indicados">
                        <p>Bradley Cooper - Maestro</p>
                        <p>Colman Domingo - Rustin</p>
                        <p>Paul Giamatti - Os rejeitados</p>
                        <p>Cillian Murphy - Oppenheimer</p>
                        <p>Jeffrey Wright - American Fiction</p>
                    </div>

                    <br>
                    <h2>Melhor direção</h2>
                    <div class="filmes-indicados">
                        <p>Yorgos Lanthimos - Pobres criaturas</p>
                        <p>Jonathan Glazer - Zona de interesse</p>
                        <p>Christopher Nolan - Oppenheimer</p>
                        <p>Martin Scorsese - Assassinos da Lua das Flores</p>
                        <p>Justine Triet - Anatomia de uma queda</p>
                        <p>Melhor ator coadjuvante</p>
                        <p>Sterling K. Brown - American Fiction</p>
                        <p>Robert Downey Jr. – Oppenheimer</p>
                        <p>Mark Ruffalo - Pobres Criaturas</p>
                        <p>Robert De Niro – Assassinos da Lua das Flores</p>
                        <p>Ryan Gosling – Barbie</p>

                    </div>
                    <br>
                    <h2>Melhor atriz coadjuvante</h2>
                    <div class="filmes-indicados">
                        <p>Emily Blunt - Oppenheimer</p>
                        <p>Danielle Brooks - A cor púrpura</p>
                        <p>America Ferrera - Barbie</p>
                        <p>Jodie Foster - Nyad</p>
                        <p>Da'vine Joy Randolph - Os rejeitados</p>

                    </div>
                    <br>
                    <h2>Melhor filme internacional</h2>
                    <div class="filmes-indicados">
                        <p>The Teachers’ Lounge - Alemanha</p>
                        <p>Io Capitano - Itália</p>
                        <p>Perfect Days - Japão</p>
                        <p>Sociedade da neve - Espanha</p>
                        <p>Zona de Interesse - Reino Unido</p>
                    </div>
                    <br>

                    <h2>Melhor roteiro adaptado</h2>
                    <div class="filmes-indicados">
                        <p>American Fiction</p>
                        <p>Barbie</p>
                        <p>Oppenheimer</p>
                        <p>Pobres Criaturas</p>
                        <p>Zona de interesse</p>
                    </div>

                    <br>
                    <h2>Melhor roteiro original</h2>
                    <div class="filmes-indicados">
                        <p>Anatomia de uma queda</p>
                        <p>Os rejeitados</p>
                        <p>Maestro</p>
                        <p>Segredos de um escândalo</p>
                        <p>Vidas Passadas</p>

                    </div>
                    <br>
                    <h2>Melhor fotografia</h2>
                    <div class="filmes-indicados">
                        <p>Hoyte van Hoytema - Oppenheimer</p>
                        <p>Matthew Libatique - Maestro</p>
                        <p>Rodrigo Prieto - Assassinos da Lua das Flores</p>
                        <p>Robbie Ryan - Pobres criaturas</p>
                        <p>Edward Lachman - El Conde</p>
                    </div>
                    <br>

                    <h2>Melhor canção original</h2>
                    <div class="filmes-indicados">
                        <p>"It Never Went Away", Jon Batiste - American Symphony</p>
                        <p>"I’m Just Ken", Mark Ronson e Andrew Wyatt - Barbie</p>
                        <p>"What Was I Made For?", Billie Eilish e Finneas - Barbie</p>
                        <p>"The Fire Inside", Diane Warren - Flamin’ Hot</p>
                        <p>"Wahzhazhe (A Song For My People)", Osage Tribal Singers - Assassinos da Lua das Flores</p>

                    </div>
                    <br>

                    <h2>Melhor animação</h2>
                    <div class="filmes-indicados">
                        <p>O menino e a garça</p>
                        <p>Elementa</p>
                        <p>Nimona</p>
                        <p>Homem-Aranha: Através do Aranhaverso</p>
                        <p>Meu amigo robô</p>
                    </div>

                    <br>
                    <h2>Melhor trilha sonora</h2>
                    <div class="filmes-indicados">
                        <p>Laura Karpman - American Fiction</p>
                        <p>John Williams - Indiana Jones e a Relíquia do Destino</p>
                        <p>Robbie Robertson - Assassinos da Lua das Flores</p>
                        <p>Ludwig Göransson - Oppenheimer</p>
                        <p>Jerskin Fendrix - Pobres criaturas</p>
                    </div>


                    <br>

                    <h2>Melhor figurino</h2>
                    <div class="filmes-indicados">
                        <p>Jacqueline Durran - Barbie</p>
                        <p>Jacqueline West - Assassinos da Lua das Flores</p>
                        <p>Holly Waddington - Pobres criaturas</p>
                        <p>Janty Yates e Dave Crossman - Napoleão</p>
                        <p>Ellen Mirojnick – Oppenheimer</p>
                    </div>
                    <br>

                    <h2>Melhor curta de animação</h2>
                    <div class="filmes-indicados">
                        <p>Letter to a Pig</p>
                        <p>Ninety-Five Senses</p>
                        <p>Our Uniform</p>
                        <p>Pachyderme</p>
                        <p>War Is Over! Inspired by the Music of John & Yoko</p>
                    </div>

                    <br>

                    <h2>Melhor maquiagem</h2>
                    <div class="filmes-indicados">
                        <p>Golda</p>
                        <p>Maestro</p>
                        <p>Oppenheimer</p>
                        <p>Pobres criaturas</p>
                        <p>Sociedade da neve</p>

                    </div>

                    <br>

                    <h2>Melhor design de produção</h2>
                    <div class="filmes-indicados">
                        <p>Barbie</p>
                        <p>Assassinos da Lua das Flores</p>
                        <p>Oppenheimer</p>
                        <p>Pobres criaturas</p>
                        <p>Napoleão</p>
                    </div>


                    <br>

                    <h2>Melhores efeitos visuais</h2>
                    <div class="filmes-indicados">
                        <p>Resistência</p>
                        <p>Godzilla Minus One</p>
                        <p>Guardiões da Galáxia Vol. 3</p>
                        <p>Missão: Impossível - Acerto de Contas Parte Um</p>
                        <p>Napoleão</p>

                    </div>

                    <br>

                    <h2>Melhor som</h2>
                    <div class="filmes-indicados">
                        <p>Resistência</p>
                        <p>Maestro</p>
                        <p>Missão: Impossível - Acerto de Contas Parte Um</p>
                        <p>Oppenheimer</p>
                        <p>Zona de interesse</p>
                    </div>


                    <br>
                    <h2>Melhor documentário</h2>
                    <div class="filmes-indicados">
                        <p>Bobi Wine: The People’s President</p>
                        <p>The Eternal Memory</p>
                        <p>Four Daughters</p>
                        <p>To Kill a Tiger</p>
                        <p>20 Days in Mariupol</p>
                    </div>


                    <br>
                    <h2>Melhor documentário curta</h2>
                    <div class="filmes-indicados">
                        <p>The ABCs of Book Banning</p>
                        <p>The Barber of Little Rock</p>
                        <p>Island in Between</p>
                        <p>The Last Repair Shop</p>
                        <p>Nǎi Nai & Wài Pó</p>
                    </div>
                </div>
            </div>
            @vite('resources/js/app.js')
    </x-Layout>
