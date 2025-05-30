@extends('layouts.app')

@section('title', 'Detalles de Facultad')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detalles de la Facultad</h1>
        
        <div class="space-y-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Nombre:</h2>
                <p class="mt-1 text-sm text-gray-900">{{ $facultad->descripcion }}</p>
            </div>
            
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Institución:</h2>
                <p class="mt-1 text-sm text-gray-900">{{ $facultad->institucion->nombre }}</p>
            </div>
            
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Departamentos:</h2>
                @forelse($facultad->departamentos as $departamento)
                    <p class="mt-1 text-sm text-gray-900">{{ $departamento->descripcion }}</p>
                @empty
                    <p class="mt-1 text-sm text-gray-500">No hay departamentos registrados</p>
                @endforelse
            </div>
        </div>
        
        <div class="flex justify-end mt-6">
            <a href="{{ route('facultades.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection