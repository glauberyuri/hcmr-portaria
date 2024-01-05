<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Portaria Hospital Internação') }}
        </h2>
    </x-slot>
    <!-- MODAL CREATE VISITANTE -->
    <div class="modal" id="ModelVisitanteNovo" tabindex="-1">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Visitante</h5>
                </div>
                <form action="#" method="post" id="add_visitante_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Nome Completo</label>
                                        <div class="relative mt-2 rounded-md shadow-sm">
                                            <input type="text" name="visitante" id="visitante" class=" w-full rounded-md border-0  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="">
                                        </div>
                                </div>
                                <div class="col-sm">
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">RG / CPF</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <input type="text" name="RGvisitante" id="visitante" class="block w-full rounded-md border-0  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Telefone</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <input type="text" name="CPFvisitante" id="CPFvisitante" class="block w-full rounded-md border-0  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" id="btn_add_visitante" class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL CREATE VISITA -->
    <div class="modal" id="ModelVisitaHospitalar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Visita Hospitalar</h5>
                </div>
                <form action="#" method="post" id="add_visita_form" enctype="multipart/form-data">
                    <div class="modal-body">
                            @csrf
                            <div class="row g-2">
                                <div class="col-sm-12">
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Nome Paciente</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <input type="text" name="nome_paciente" id="nome_paciente" class=" w-full rounded-md border-0  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Unidade de Internação</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <input type="text" name="unidade_internacao" id="unidade_internacao" class="block w-full rounded-md border-0  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-8 ">
                                    <label for="visitanteSelect" class="block text-sm font-medium leading-6 text-gray-900">Visitante</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <select id="visitanteSelect" name="visitanteSelect" style="width: 100%; height: 100%" class="select2 h-full w-full rounded-md border-0 bg-transparent  text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Parentesco</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <select id="parentescoSelect" name="parentescoVisitante" class="h-full w-full rounded-md border-0 bg-transparent  text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                            <option>IRMÂO/IRMÃ</option>
                                            <option>FILHO/FILHA</option>
                                            <option>PAI</option>
                                            <option>MAE</option>
                                            <option>PRIMO</option>
                                            <option>AMIGO</option>
                                            <option>TIO/TIA</option>
                                            <option>PADRE</option>
                                            <option>NÃO IDENTIFICADO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Observação</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <textarea type="text" name="observacao" id="observacao" class="block w-full rounded-md border-0  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" id="btn_visita_novo" class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-x-auto ">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <div class="p-6 d-flex pb-5 justify-content-between border-b border-gray-100">
                                        <!-- Table -->
                                        <header class="px-3 py-3">
                                            <h2 class="font-semibold text-gray-800">Todos os Pacientes</h2>
                                        </header>
                                        <button type="button" class="h-10 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-bs-toggle="modal" data-bs-target="#ModelVisitanteNovo">
                                            Criar Novo Visitante
                                        </button>
                                    </div>
                                    <div class="p-3 pt-5 d-flex justify-content-center gap-6">
                                        <input type="text" name="paciente" id="GetPaciente" class="block w-50 h-10 rounded-md border-0 py-1.5  pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Nome do Paciente">
                                        <button type="button" id="Btn_Pesquisar" class="h-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Pesquisar
                                        </button>
                                    </div>
                                    <div id="loading" class="position-absolute top-50 start-50 translate-middle" style="display: none;">
                                        Carregando...
                                    </div>
                                    <div  id="searh_list" class="d-flex align-items-center p-5">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

