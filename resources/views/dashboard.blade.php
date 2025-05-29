@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Bienvenido, {{ Auth::user()->username }}</h1>
        <p class="mt-2 text-gray-600">Gestión completa del sistema de proyectos</p>
    </div>

    <!-- Grid estilo Bento -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Tarjeta Usuarios -->
        <a href="{{ route('usuarios.index') }}" class="bento-card bg-gradient-to-br from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Usuarios</h3>
                    <p class="text-indigo-100 mt-1">Gestión de cuentas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">CRUD completo</span>
            </div>
        </a>

        <!-- Tarjeta Proyectos -->
        <a href="{{ route('proyectos.index') }}" class="bento-card bg-gradient-to-br from-blue-500 to-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Proyectos</h3>
                    <p class="text-blue-100 mt-1">PA y PIA</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-project-diagram text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">+10 nuevos</span>
            </div>
        </a>

        <!-- Tarjeta Estudiantes -->
        <a href="{{ route('estudiantes.index') }}" class="bento-card bg-gradient-to-br from-green-500 to-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Estudiantes</h3>
                    <p class="text-green-100 mt-1">Gestión académica</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">120 registrados</span>
            </div>
        </a>

        <!-- Tarjeta Docentes -->
        <a href="{{ route('docentes.index') }}" class="bento-card bg-gradient-to-br from-amber-500 to-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Docentes</h3>
                    <p class="text-amber-100 mt-1">Profesores</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">30 registrados</span>
            </div>
        </a>

        <!-- Tarjeta Evaluaciones -->
        <a href="{{ route('evaluaciones.index') }}" class="bento-card bg-gradient-to-br from-rose-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Evaluaciones</h3>
                    <p class="text-rose-100 mt-1">Calificaciones</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">15 pendientes</span>
            </div>
        </a>

        <!-- Tarjeta Asignaturas -->
        <a href="{{ route('asignaturas.index') }}" class="bento-card bg-gradient-to-br from-violet-500 to-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Asignaturas</h3>
                    <p class="text-violet-100 mt-1">Materias académicas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-book text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">45 registradas</span>
            </div>
        </a>

        <!-- Tarjeta tipo proyectos -->
        <a href="{{ route('tipo-proyectos.index') }}" class="bento-card bg-gradient-to-br from-purple-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Tipos de Proyecto</h3>
                    <p class="text-purple-100 mt-1">PA y PIA</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">Categorías</span>
            </div>
        </a>
    </div>

    <!-- Sección rápida -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Acciones rápidas -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Acciones rápidas</h3>
            <div class="space-y-3">
                <a href="{{ route('proyectos.create') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3">
                        <i class="fas fa-plus"></i>
                    </div>
                    <span>Nuevo proyecto</span>
                </a>
                <a href="{{ route('estudiantes.create') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span>Registrar estudiante</span>
                </a>
                <a href="{{ route('docentes.create') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                    <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mr-3">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <span>Registrar docente</span>
                </a>
            </div>
        </div>

        <!-- Última actividad -->
        <div class="bg-white rounded-2xl shadow-sm p-6 md:col-span-2">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Actividad reciente</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Nuevo proyecto creado</p>
                        <p class="text-sm text-gray-500">Sistema de gestión académica</p>
                        <p class="text-xs text-gray-400 mt-1">Hace 2 horas</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Estudiante registrado</p>
                        <p class="text-sm text-gray-500">Juan Pérez - Ingeniería</p>
                        <p class="text-xs text-gray-400 mt-1">Ayer, 3:45 PM</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mr-3">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Evaluación completada</p>
                        <p class="text-sm text-gray-500">Proyecto de base de datos</p>
                        <p class="text-xs text-gray-400 mt-1">Ayer, 10:30 AM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection