<x-action-section>
    <x-slot name="title">
        {{ __('Redefinir senha') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Se necessário, você pode resetar a sua senha aqui') }}
    </x-slot>
    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Quando um usuário se cadastra através do google é gerada uma senha aleatória e secreta, porém, caso o usuário deseje
                                                                                                                fazer alterações no perfil é necessário realizar a redefinição de senha. Clique no botão abaixo para redefinir a sua senha (você será deslogado e enviaremos um link de redefinição de senha para o seu email).') }}
        </div>

        <div class="flex items-center mt-5">
            <form action="http://127.0.0.1:8000/resetar-senha" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                    wire:click="mudarTextoBotao" wire:loading.attr="disabled" wire:target="mudarTextoBotao">
                    {{ $textoBotao }}
                </button>
            </form>
        </div>
    </x-slot>
</x-action-section>
