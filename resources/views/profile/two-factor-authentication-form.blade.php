<x-action-section>
    <x-slot name="title">
        {{ __('Autenticação de dois fatores') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Adicione mais segurança em sua conta ao ativar a autenticação de dois fatores.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-100 dark:text-gray-100">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Termine de adicionar a autenticação de dois fatores.') }}
                @else
                    {{ __('A autenticação de dois fatores está ativada.') }}
                @endif
            @else
                {{ __('A autenticação de dois fatores não está ativada.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-400 dark:text-gray-400">
            <p>
                {{ __('Quando a autenticação de dois fatores está ativada, é solicitado um código seguro e aleatório ao tentar entrar em sua conta, esse código é gerado pelo aplicativo autenticador do seu telefone, utilizado no momento da ativação dessa funcionalidade.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-400 dark:text-gray-400">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Para completar a ativação da autenticação de dois fatores, escaneie o seguinte código QR com o aplicativo de autenticação em seu celular ou insira o código de ativação no seu autenticador e depois insira o código OTP gerado por ele.') }}
                        @else
                            {{ __('A autenticação de dois fatores agora está ativada. Escaneie o seguinte código QR usando o aplicativo de autenticador em seu celular ou insira a chave de ativação.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('Código de ativação') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('Código OTP') }}" />

                        <x-input id="code" type="text" name="code" class="block mt-1 w-1/2"
                            inputmode="numeric" autofocus autocomplete="one-time-code" wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('Guarde estes códigos de recuperação de forma segura. Eles podem ser usados para recuperar o acesso à sua conta caso você perca seu o aparelho') }}
                    </p>
                </div>

                <div
                    class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (!$this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-secondary-button type="button" wire:loading.attr="disabled">
                        {{ __('Ativar') }}
                    </x-secondary-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Gerar novos Códigos de Recuperação') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-secondary-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Mostrar códigos de recuperação') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('Desativar') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
