<div class="overlay-login" id="overlay-login">
    @guest
        <div class="usuario-deslogado">
            <div class="div-logo-deslogado">
                <x-authentication-card-logo />
            </div>
            <button type="button" class="botao-fechar-login" id="botao-fechar-login">Fechar</button>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="form-login">
                @csrf

                <div class="dados-login">
                    <label for="email">Email</label>
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="username" />
                </div>

                <div class="dados-login">

                    <label for="password">Senha</label>
                    <input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <div class="dados-login">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Lembrar de mim</span>
                    </label>
                </div>


                <div class="dados-login">
                    <x-button class="ml-4">
                        {{ __('Entrar') }}
                    </x-button>

                    @if (Route::has('password.request'))
                        <div class="links-formulario">
                            <a href="{{ route('password.request') }}">
                                Esqueceu a senha?
                            </a>
                            <a href="{{ route('register') }}">Cadastrar-se</a>
                        </div>
                    @endif

                </div>
            </form>
        </div>
    @endguest

    @auth
        <div class="usuario-logado">
            <div class="div-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/TCFLogoSite.svg') }}" alt="logotipo-amarelo">
                </a>

            </div>
            <div class="div-imagem ">
                @if (session('fotoPerfil'))
                    <img src="{{ session('fotoPerfil') }}" alt="foto-perfil">
                @elseif (auth()->user()->profile_photo_path)
                    <img src="{{ auth()->user()->profile_photo_path }}" alt="foto-perfil">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#6387CF" height="70" viewBox="0 -960 960 960"
                        width="70">
                        <path
                            d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.814-195Q422-450 382.5-489.686q-39.5-39.686-39.5-97.5t39.686-97.314q39.686-39.5 97.5-39.5t97.314 39.686q39.5 39.686 39.5 97.5T577.314-489.5q-39.686 39.5-97.5 39.5Zm.654 370Q398-80 325-111.5q-73-31.5-127.5-86t-86-127.266Q80-397.532 80-480.266T111.5-635.5q31.5-72.5 86-127t127.266-86q72.766-31.5 155.5-31.5T635.5-848.5q72.5 31.5 127 86t86 127.032q31.5 72.532 31.5 155T848.5-325q-31.5 73-86 127.5t-127.032 86q-72.532 31.5-155 31.5ZM480-140q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z" />
                    </svg>
                @endif
            </div>
            <div class="nome-usuario"><span>Bem vindo(a), {{ session('nomeUsuario') }} !</span></div>
            <ul>
                <li>
                    <a href="{{ route('profile') }}">
                        <p>Configurações</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('minhasListas') }}">
                        <p>Minhas Listas</p>
                    </a>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                </li>
                <li>
                    <button type="button" class="botao-fechar-login" id="botao-fechar-login">Fechar</button>
                </li>
            </ul>
        </div>
    @endauth
</div>
