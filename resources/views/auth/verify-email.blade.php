<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}">
                <x-authentication-card-logo />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-400 dark:text-gray-400">
            {{ __('Você precisa fazer a verificação de cadastro, clicando no link que foi enviado para o seu e-mail. Verifique se o e-mail não foi enviado para sua caixa de spam. Clique em reenviar e-mail de confirmação caso não tenha recebido.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-400">
                {{ __('Um novo link de verificação foi enviado para o seu email. Lembre-se de verificar a caixa de spam') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-around">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                @if (session('status') != 'verification-link-sent')
                    <div>
                        <x-button type="submit" id="botao-reenviar-email-confirmacao">
                            {{ __('Reenviar Email de verificação') }}
                        </x-button>
                    </div>
                @endif

            </form>

            <div>

                {{-- <a href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-400 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Editar Conta') }}</a> --}}


                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit"
                        class="underline text-sm text-gray-400 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ml-2">
                        {{ __('Sair') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
    @vite('resources/js/verify-email.js')
</x-guest-layout>
