<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Voce esta logado como") }}
                    {{ __(auth()->user()->user_type) }}
                    {{ __("!") }}
                </div>
                @if(auth()->user()->user_type === 'responsavel')
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Adicionar aluno") }}
                </div>
                @elseif(auth()->user()->user_type === 'motorista')
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Adicionar Veiculo") }}
                </div>
                @endif
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(auth()->user()->user_type == 'motorista')
                    <h2>{{ auth()->user()->name}}</h2>
                    <h2>{{ auth()->user()->user_type }}</h2>
                    @endif

                    @if(auth()->user()->user_type == 'responsavel')
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nome Aluno
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Escola
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Motorista
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Apple MacBook Pro 17"
                                    </th>
                                    <td class="px-6 py-4">
                                        Silver
                                    </td>
                                    <td class="px-6 py-4">
                                        Laptop
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>