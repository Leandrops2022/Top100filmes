<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>


    @auth
        <p class="text-gray-400 text-center text-xl">
            Bem vindo, {{ auth()->user()->name }}. @if (session('status'))
                <span class="text-green-600">{{ session('status') }}</span>
            @endif
        </p>
    @endauth


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        {{-- @if (Laravel\Fortify\Features::canUpdateProfileInformation() && !auth()->user()->gauth_id)
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif --}}

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-section-border />
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>

            <x-section-border />
        @endif

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        <x-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('reset-de-senha')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
    </div>
    @vite('resources/js/profile.js')
</x-app-layout>
