<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Atualizar Senha') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Prefira utilizar senhas longas e aleatórias para manter sua conta segura.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Senha Atual') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full"
                wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Nova Senha') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password"
                autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirmar Senha') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full"
                wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3 text-green-400" on="saved">
            {{ __('Senha Atualizada com sucesso!') }}
        </x-action-message>

        <x-secondary-button class="text-gray-400">
            {{ __('Salvar') }}
        </x-secondary-button>
    </x-slot>
</x-form-section>
