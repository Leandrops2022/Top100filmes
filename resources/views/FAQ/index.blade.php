<x-Layout>
    @vite('resources/css/faq.scss')


    @section('titulo', trim('Top 100 filmes - Perguntas Frequentes'))
    @section('description',
        'Tem alguma dúvida? veja se já há uma resposta para sua dúvida abaixo, caso não, entre em
        contato conosco')


        <div class="faq">
            <h1>Perguntas Frequentes</h1>
            <div class="lista-faq">
                <ol>

                    <li>
                        <h4 id="1">Como são elaborados os top?</h4>
                        <p id="resposta-1">
                            Os top 100 dos filmes, de forma inicial, são listas elaboradas pelos editores do site, levando
                            em
                            consideração o gosto pessoal da nossa equipe.Conforme a votação dos usuários ocorre, alteramos
                            mensalmente
                            os rankings.
                        </p>
                    </li>

                    <li>
                        <h4 id="2">O que é o Top 100 geral?</h4>
                        <p id="resposta-2">
                            Os filmes entram no top 100 geral de acordo com a votação,
                            levando em consideração a nota média que os filmes possuem, calculada com as notas
                            recebidas das votações dos usuários. Apenas filmes com um número de votos acima de um limite
                            mínimo são considerados
                            para o cálculo.
                        </p>

                    </li>

                    <li>
                        <h4 id="3">Como é feito o cálculo das notas dos filmes?</h4>
                        <p id="resposta-3">
                            O cálculo das notas dos filmes é feito através da média aritmética simples, ou seja, pegamos
                            todos
                            os votos
                            dos usuários no filme, somamos todos eles e depois dividimos pela quantidade total de votos
                            recebidos nesse
                            filme. Acreditamos que o voto de nosso usuário não deve ter menos importância do que o voto de
                            um
                            crítico de
                            cinema, aqui no top 100 filmes, prezamos pela igualdade.
                        </p>
                    </li>

                    <li>
                        <h4 id="4">Com que frequencia as notas dos filmes são atualizadas?</h4>
                        <p id="resposta-4">
                            As notas são atualizadas mensalmente
                        </p>
                    </li>

                    <li>
                        <h4 id="5">Como funcionam as Listas dos usuários</h4>
                        <p id="resposta-5">
                            Cada usuário tem uma lista chamada "O que assistir", onde pode adicionar os filmes que mais
                            gosta ou que ainda pretende
                            assistir.Os Filmes podem ser adicionados clicando no botão adicionar (+), nas áreas dos top100,
                            nas buscas ou na
                            página de detalhes dos filmes.Ao adicionar pela página nos top100 não se esqueça de salvar as
                            alterações.
                        </p>
                    </li>
                    <li>
                        <h4 id="6">Não estou conseguindo adicionar filmes à minha lista, o que fazer nesse caso?
                        </h4>
                        <p id="resposta-6">
                            Caso você esteja enfrentando problemas na hora de adicionar um filme na sua lista, pedimos que
                            você
                            faça o logout (sair) da conta e faça um novo login (entrar). Caso o problema persista, entre em
                            contato
                            conosco clicando <a href="{{ route('contato') }}">aqui</a> e selecione a opção
                            reportar bugs.
                        </p>
                    </li>

                </ol>

            </div>
        </div>
        @vite('resources/js/faq.js')
    </x-Layout>
