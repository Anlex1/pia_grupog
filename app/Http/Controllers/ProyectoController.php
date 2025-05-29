<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\TipoProyecto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProyectoController extends Controller
{
    public function index(): JsonResponse
    {
        $proyectos = Proyecto::with('tipoProyecto', 'asignaturas', 'evaluaciones')->get();
        return response()->json($proyectos);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fechaInicio' => 'nullable|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'tipoProyectoId' => 'required|exists:tiposProyecto,id'
        ]);

        $proyecto = Proyecto::create($request->all());
        $proyecto->load('tipoProyecto');
        return response()->json($proyecto, 201);
    }

    public function show(Proyecto $proyecto): JsonResponse
    {
        $proyecto->load([
            'tipoProyecto',
            'asignaturas.programa',
            'evaluaciones.evaluador'
        ]);
        return response()->json($proyecto);
    }

    public function update(Request $request, Proyecto $proyecto): JsonResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fechaInicio' => 'nullable|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'tipoProyectoId' => 'required|exists:tiposProyecto,id'
        ]);

        $proyecto->update($request->all());
        $proyecto->load('tipoProyecto');
        return response()->json($proyecto);
    }

    public function destroy(Proyecto $proyecto): JsonResponse
    {
        $proyecto->delete();
        return response()->json(['message' => 'Proyecto eliminado correctamente']);
    }

    public function asignarAsignatura(Request $request, Proyecto $proyecto): JsonResponse
    {
        $request->validate([
            'asignaturaId' => 'required|exists:asignaturas,id',
            'docenteId' => 'required|exists:docentes,id',
            'grupo' => 'nullable|string|max:10',
            'semestre' => 'nullable|integer',
            'año' => 'nullable|integer'
        ]);

        $proyecto->asignaturas()->attach($request->asignaturaId, [
            'docenteId' => $request->docenteId,
            'grupo' => $request->grupo,
            'semestre' => $request->semestre,
            'año' => $request->año
        ]);

        return response()->json(['message' => 'Asignatura asignada al proyecto correctamente']);
    }

    public function getActivos(): JsonResponse
    {
        $proyectos = Proyecto::activos()->with('tipoProyecto', 'asignaturas')->get();
        return response()->json($proyectos);
    }
}
