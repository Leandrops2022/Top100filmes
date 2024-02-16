<x-Layout>
    @vite('resources/css/contato.scss')

    @section('titulo', trim('Top 100 filmes - Contato'))
    @section('description',
        'Preencha o formulário abaixo para entrar em contato conosco. Escolha um assunto e digite
        sua mensagem.')

        <div class="intro-contato">
            <h1>Entre em contato</h1>
            <p>Preencha o formulário abaixo para entrar em contato conosco. Escolha um assunto e digite sua mensagem.</p>
        </div>
        <form action=" {{ route('contatoUsuario') }}" method="POST" class="entre-em-contato">
            @csrf
            <div class="dados-pessoais">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" required>
                <label for="birthdate">Data de Nascimento</label>
                <input type="date" name="birthdate" id="birthdate" class="data-nascimento" required
                    placeholder='12121212121'>
                <label for="email">Informe seu e-mail de contato</label>
                <input type="email" name="email" id="email-contato" required>
            </div>

            <div class="dados-mensagem">

                <select name="contactType" id="seletor-tipo-contato" required>
                    <option disabled selected value="">Selecione o motivo do contato</option>
                    <option name="contactType" value="bugreport">Reportar um bug</option>
                    <option name="contactType" value="sugestoes">Fazer sugestão</option>
                    <option name="contactType" value="reclamacoes">Fazer uma reclamação</option>
                </select>
                <label for="message">Digite sua mensagem abaixo</label>
                <textarea name="message" id="message" cols="30" rows="10" maxlength="4000" required></textarea>
            </div>

            <button type="submit">Enviar</button>
        </form>
        @vite('resources/js/app.js')

    </x-Layout>
