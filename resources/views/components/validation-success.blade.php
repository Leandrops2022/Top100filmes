@vite('resources/css/validationSuccess.scss')
@if (session('mensagemSucesso'))
    <div id="div-mensagem-sucesso" class="sucesso">
        <span id="mensagem">
            {{ session('mensagemSucesso') }}
        </span>
    </div>
@endif
