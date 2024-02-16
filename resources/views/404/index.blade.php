<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @vite('resources/css/404.scss')
    <div class="div-centralizada">
        <div class="imagem-perdido">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/perdido.gif') }}" alt="imagem-deserto">
            </a>
        </div>
        <h1>404 - Conteúdo Não encontrado</h1>
        <h2> Oh não! Parece que você se perdeu...</h2>

        <a href="{{ route('home') }}">
            <h2>voltar</h2>
        </a>
    </div>
</body>

</html>
