<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Visitantes Hospitalar') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                    <!-- Table -->
                        <header class="px-3 py-3 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Todas as Visitas</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full" id="lista-visitantes">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace">
                                            <div class="font-semibold text-left">Nome do Paciente</div>
                                        </th>
                                        <th class="p-2 whitespace">
                                            <div class="font-semibold text-left">Internação</div>
                                        </th>
                                        <th class="p-2 whitespace">
                                            <div class="font-semibold text-left">Visitante</div>
                                        </th>
                                        <th class="p-2 whitespace">
                                            <div class="font-semibold text-left">Parentesco</div>
                                        </th>
                                        <th class="p-2 whitespace">
                                            <div class="font-semibold text-left">Observação</div>
                                        </th>
                                        <th class="p-2 whitespace">
                                            <div class="font-semibold text-left">DATA</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
