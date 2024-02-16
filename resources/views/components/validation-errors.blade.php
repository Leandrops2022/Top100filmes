@vite('resources/css/validationErrors.scss')
@if ($errors->any())
    <div {{ $attributes }}>
        <div class="mensagem-erro">
            {{ __('Parece que algo deu errado!') }}
        </div>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="mensagem-erro">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@vite('resources/js/validationErrors.js')
