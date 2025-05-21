<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> -->

    <!-- Agregado para un Menú -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Menú de opciones</h3>
                <ul class="list-disc ml-5 space-y-2">
                
                    <li>
                        <a href="{{ route('tipo-proyectos.index') }}" class="text-blue-600 hover:underline">
                        Tipos de Proyecto
                        </a>
                    </li>
                    
                    <li><a class="text-blue-600 hover:underline">Instituciones</a></li>
                    <li><a class="text-blue-600 hover:underline">Facultades</a></li>
                    <li><a class="text-blue-600 hover:underline">Departamentos</a></li>
                    <li><a class="text-blue-600 hover:underline">Programas</a></li>
                    <li><a class="text-blue-600 hover:underline">Asignaturas</a></li>
                    <li><a class="text-blue-600 hover:underline">Docentes</a></li>
                    <li><a class="text-blue-600 hover:underline">Estudiantes</a></li>
                    <li><a class="text-blue-600 hover:underline">Evaluadores</a></li>
                </ul>
                
            </div>
        </div>
    </div>


</x-app-layout>
