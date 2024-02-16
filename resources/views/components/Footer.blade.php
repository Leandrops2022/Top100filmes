<footer class="rodape" id="rodape">
    <div class="conteudo-rodape">

        <div class="redes-sociais">
            <ul class="lista-icones">

                <li class="lista-icones_item">
                    <a href="https://www.instagram.com/top100filmes/" target="blank"
                        referrerpolicy="no-referrer-when-downgrade" role="button">
                        <img src="{{ asset('/assets/icones/icone-instagram.svg') }}" alt="icone-instagram">
                    </a>
                </li>
                <li class="lista-icones_item">
                    <a href="https://twitter.com/Top100Filmes" target="blank"
                        referrerpolicy="no-referrer-when-downgrade" role="button">
                        <img src="{{ asset('/assets/icones/icone-twitter-x.svg') }}" alt="icone-twitter">
                    </a>
                </li>
                <li class="lista-icones_item">
                    <a href="https://www.youtube.com/channel/UC3N_8TNkLV_xnTl1nKA_a9Q" target="blank"
                        referrerpolicy="no-referrer-when-downgrade" role="button">
                        <img src="{{ asset('/assets/icones/icone-youtube.svg') }}" alt="icone-youtube">
                    </a>
                </li>
                <li class="lista-icones_item">
                    <a href="https://www.facebook.com/profile.php?id=61550866439467" target="blank"
                        referrerpolicy="no-referrer-when-downgrade" role="button">
                        <img src="{{ asset('/assets/icones/icone-facebook.svg') }}" alt="icone-facebook">
                    </a>
                </li>
            </ul>

        </div>

        <div class="conteudo-central">
            <ul>
                <li>
                    <a target="_blank" href="{{ route('policy.show') }}" role="button" class="abre-politica"
                        id="politica-privacidade">
                        <div>Política de privacidade</div>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="{{ route('terms.show') }}" role="button" class="abre-condicoes"
                        id="condicoes-de-uso">
                        <div>Condições de uso</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('perguntasFrequentes') }}">
                        <div>Perguntas Frequentes</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contato') }}">
                        <div>Entre em contato</div>
                    </a>
                </li>
            </ul>

            <p>
                Todas as imagens utilizadas são de propriedade dos seus respectivos donos, e seu uso está
                restrito às permissões concedidas para fins de divulgação.
            </p>
            <span>
                2024, Dominionlps
            </span>
            <span class="versionamento">versão atual 2.1</span>
        </div>

    </div>

</footer>
