@extends('layouts.app')

@section('title', 'Proyectos para Evaluar')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Proyectos para Evaluar</h1>
                    <p class="text-muted">Selecciona un proyecto para crear una evaluación</p>
                </div>
                <div>
                    <a href="{{ route('evaluaciones.lista') }}" class="btn btn-info">
                        <i class="fas fa-list me-2"></i>Ver Evaluaciones Realizadas
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Proyectos</h6>
        </div>
        <div class="card-body">
            @if($proyectos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Fecha Inicio</th>
                                <th>Evaluaciones</th>
                                <th>Promedio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proyectos as $proyecto)
                                <tr>
                                    <td>{{ $proyecto->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $proyecto->titulo }}</div>
                                        @if($proyecto->descripcion)
                                            <small class="text-muted">{{ Str::limit($proyecto->descripcion, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $proyecto->tipoProyecto->nombre ?? 'Sin tipo' }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $estadoClass = match($proyecto->estado) {
                                                'planificado' => 'bg-warning',
                                                'en_desarrollo' => 'bg-info',
                                                'terminado' => 'bg-success',
                                                'evaluado' => 'bg-primary',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $estadoClass }}">
                                            {{ $proyecto->estadoFormateado() }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $proyecto->fechaInicio ? $proyecto->fechaInicio->format('d/m/Y') : 'No definida' }}
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $proyecto->evaluaciones->count() }} evaluación(es)
                                        </span>
                                    </td>
                                    <td>
                                        @if($proyecto->promedioEvaluacion())
                                            <span class="badge bg-success">
                                                {{ $proyecto->promedioEvaluacion() }}/10
                                            </span>
                                        @else
                                            <span class="text-muted">Sin evaluar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('evaluaciones.create', ['proyecto_id' => $proyecto->id]) }}" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-star me-1"></i>Evaluar
                                            </a>
                                            
                                            @if($proyecto->evaluaciones->count() > 0)
                                                <button class="btn btn-info btn-sm" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#modalEvaluaciones{{ $proyecto->id }}">
                                                    <i class="fas fa-eye me-1"></i>Ver
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-folder-open fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted">No hay proyectos disponibles</h5>
                    <p class="text-muted">No se encontraron proyectos para evaluar.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modales para ver evaluaciones -->
@foreach($proyectos as $proyecto)
    @if($proyecto->evaluaciones->count() > 0)
        <div class="modal fade" id="modalEvaluaciones{{ $proyecto->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Evaluaciones - {{ $proyecto->titulo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @foreach($proyecto->evaluaciones as $evaluacion)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Evaluador:</strong> {{ $evaluacion->evaluador->nombreCompleto }}
                                    <span class="float-end text-muted">
                                        {{ $evaluacion->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @php
                                            $criterios = [
                                                'contenido' => 'Contenido',
                                                'problematizacion' => 'Problematización',
                                                'objetivos' => 'Objetivos',
                                                'metodologia' => 'Metodología',
                                                'resultados' => 'Resultados',
                                                'potencial' => 'Potencial',
                                                'interaccionPublico' => 'Interacción Público',
                                                'creatividad' => 'Creatividad',
                                                'innovacion' => 'Innovación'
                                            ];
                                        @endphp
                                        @foreach($criterios as $campo => $nombre)
                                            @if($evaluacion->$campo)
                                                <div class="col-md-4 mb-2">
                                                    <small class="text-muted">{{ $nombre }}:</small>
                                                    <div class="fw-bold">{{ $evaluacion->$campo }}/10</div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if($evaluacion->concluciones)
                                        <hr>
                                        <div>
                                            <small class="text-muted">Conclusiones:</small>
                                            <p class="mb-0">{{ $evaluacion->concluciones }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
@endsection