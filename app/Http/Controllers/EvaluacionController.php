<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Proyecto;
use App\Models\Evaluador;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EvaluacionController extends Controller
{
    public function index(): JsonResponse
    {
        $evaluaciones = Evaluacion::with('proyecto', 'evaluador')->get();
        return response()->json($evaluaciones);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'proyectoId' => 'required|exists:proyectos,id',
            'evaluadorId' => 'required|exists:evaluadores,id',
            'fechaEvaluacion' => 'nullable|date',
            'calificacion' => 'nullable|numeric|between:0,5',
            'observaciones' => 'nullable|string',
            'criteriosEvaluacion' => 'nullable|array'
        ]);

        $evaluacion = Evaluacion::create($request->all());
        $evaluacion->load('proyecto', 'evaluador');
        return response()->json($evaluacion, 201);
    }

    public function show(Evaluacion $evaluacion): JsonResponse
    {
        $evaluacion->load('proyecto.tipoProyecto', 'evaluador');
        return response()->json($evaluacion);
    }

    public function update(Request $request, Evaluacion $evaluacion): JsonResponse
    {
        $request->validate([
            'fechaEvaluacion' => 'nullable|date',
            'calificacion' => 'nullable|numeric|between:0,5',
            'observaciones' => 'nullable|string',
            'criteriosEvaluacion' => 'nullable|array'
        ]);

        $evaluacion->update($request->all());
        $evaluacion->load('proyecto', 'evaluador');
        return response()->json($evaluacion);
    }

    public function destroy(Evaluacion $evaluacion): JsonResponse
    {
        $evaluacion->delete();
        return response()->json(['message' => 'Evaluación eliminada correctamente']);
    }

    public function getByProyecto(Proyecto $proyecto): JsonResponse
    {
        $evaluaciones = $proyecto->evaluaciones()->with('evaluador')->get();
        return response()->json($evaluaciones);
    }

    public function getByEvaluador(Evaluador $evaluador): JsonResponse
    {
        $evaluaciones = $evaluador->evaluaciones()->with('proyecto')->get();
        return response()->json($evaluaciones);
    }
}