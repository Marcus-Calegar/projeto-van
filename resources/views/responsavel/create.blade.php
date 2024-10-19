<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center p-6 text-gray-900 dark:text-gray-100">
                <h1>Cadastro Responsavel</h1>
            </div>
            <form method="POST" action="{{ route('register.responsavel') }}">
                @csrf

                <div class="mt-4">
                    <x-text-input id="nome" hidden type="text" name="nome" value="{{ auth()->user()->name }}" required />
                </div>
                <div class="mt-4">
                    <x-text-input id="id" hidden type="text" name="id" value="{{ auth()->user()->id }}" required />
                </div>
                <!-- Telefone -->
                <div class="mt-4">
                    <x-input-label for="telefone" :value="__('Telefone')" />
                    <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" required />
                </div>

                <!-- Cpf -->
                <div class="mt-4">
                    <x-input-label for="cpf" :value="__('Cpf')" />
                    <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" required />
                </div>

                <!-- dataNascimento -->
                <div class="mt-4">
                    <x-input-label for="dataNascimento" :value="__('DataNascimento')" />
                    <x-text-input id="dataNascimento" class="block mt-1 w-full" type="date" name="dataNascimento" required />
                </div>

                <x-primary-button class="mt-4">
                    {{ __('Finalizar Cadastro') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>