<x-Layout :filmes="$filmes" :tap="$tap" :filmesDaLista="$filmesDaLista" :oQueAssistir="$oQueAssistir">
    @vite('resources/css/melhoresDoAno.scss')

    @section('titulo', 'Melhores Filmes de 2023')
    @section('description',
        '2023 foi um ano com bastante lançamentos, apesar da greve dos atores e roteiristas uma grande
        quantidade
        de filmes foram lançados, alguns, memoráveis e que com certeza
        entrarão para a história do cinema...')

        <div class="grid-top-100">

            <div class="conteudo-top-100">

                <div class="textos-intro-top-100 flex flex-col">
                    <div class="flex flex-col w-3/5 self-center mb-10">
                        <img width="1280px" height="720px" src="{{ asset('assets/melhores-do-ano/capaMelhores2023-2.webp') }}"
                            alt="">
                    </div>
                    <h3>Melhores filmes de 2023!</h3>

                    <div id="intro-melhores">
                        <p>
                            2023 foi um ano com bastante lançamentos, apesar da greve dos atores e roteiristas uma grande
                            quantidade
                            de filmes foram lançados, alguns, memoráveis e que com certeza
                            entrarão para a história do cinema. Mas como nem tudo são flores, tivemos alguns filmes que
                            foram no
                            mínimo
                            decepcionantes, e outros que... bem...Digamos que pra serem ruims ainda teriam que melhorar
                            muito.
                        </p>
                        <br>
                        <p>
                            Nesse top especial de fim de ano não iremos citar os piores filmes de 2023, apenas os melhores,
                            o "crème
                            de la crème", com algumas ressalvas, onde os últimos colocados são os "menos piores" e não
                            necessariamente
                            fazem parte dos melhores...e você concorda com o top? Seu filme favorito ficou de
                            fora?
                            Comente
                            nas
                            redes sociais, deixe seu voto aqui no site, compartilhe com amigos, participe!
                        </p>
                        <p>
                            Sem mais delongas, vamos aos filmes
                        </p>
                    </div>

                    @auth
                        <div class="card-salvar-alterações" id="card-salvar-alterações">
                            <p id="texto-card-salvar">Salvar alterações na lista?</p>
                            <button id="botao-salvar-alteracoes-lista">Confirmar</button>
                        </div>

                    @endauth

                    @foreach ($filmes as $filme)
                        <x-CardFilme :filme="$filme" :filmesDaLista="$filmesDaLista" />
                    @endforeach
                    <div id="container-paginacao">
                        {{ $filmes->links('vendor.pagination.default') }}
                    </div>
                    <div id="container-paginacao-responsivo">
                        {{ $filmes->links('vendor.pagination.tailwind') }}
                    </div>

                </div>
                <script>
                    const oQueAssistir = @json($oQueAssistir);
                    const listaDoUsuario = @json($filmesDaLista);
                    const tap = @json($tap);
                </script>

            </div>
            @vite('resources/js/app.js')
            @vite('resources/js/top100.js')
            @vite('resources/js/adicionaFilmeNaListaDoUsuario.js')
        </div>
        <div id="disqus_thread"></div>
        <script>
            var disqus_config = function() {
                this.page.url = "<?php echo URL::current(); ?>";
                this.page.identifier = "Melhores filmes de 2023!"

            };

            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document,
                    s = d.createElement('script');
                s.src = 'https://top100filmes.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
                Disqus.</a></noscript>
    </x-Layout>
