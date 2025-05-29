<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EstudianteController extends Controller
{
    public function index(): JsonResponse
    {
        $estudiantes = Estudiante::with('programa.departamento.facultad')->get();
        return response()->json($estudiantes);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:estudiantes',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:estudiantes',
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id'
        ]);

        $estudiante = Estudiante::create($request->all());
        $estudiante->load('programa');
        return response()->json($estudiante, 201);
    }

    public function show(Estudiante $estudiante): JsonResponse
    {
        $estudiante->load([
            'programa.departamento.facultad',
            'asignaturas' => function($query) {
                $query->withPivot('semestre', 'año', 'grupo', 'notaFinal', 'estado', 'fechaMatricula');
            }
        ]);
        return response()->json($estudiante);
    }

    public function update(Request $request, Estudiante $estudiante): JsonResponse
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:estudiantes,identificacion,' . $estudiante->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:estudiantes,email,' . $estudiante->id,
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id'
        ]);

        $estudiante->update($request->all());
        $estudiante->load('programa');
        return response()->json($estudiante);
    }

    public function destroy(Estudiante $estudiante): JsonResponse
    {
        $estudiante->delete();
        return response()->json(['message' => 'Estudiante eliminado correctamente']);
    }

    public function matricularAsignatura(Request $request, Estudiante $estudiante): JsonResponse
    {
        $request->validate([
            'asignaturaId' => 'required|exists:asignaturas,id',
            'semestre' => 'required|string|max:10',
            'año' => 'required|integer',
            'grupo' => 'nullable|string|max:10'
        ]);

        $estudiante->asignaturas()->attach($request->asignaturaId, [
            'semestre' => $request->semestre,
            'año' => $request->año,
            'grupo' => $request->grupo,
            'fechaMatricula' => now(),
            'estado' => 'matriculado'
        ]);

        return response()->json(['message' => 'Estudiante matriculado en asignatura correctamente']);
    }

    public function calificarAsignatura(Request $request, Estudiante $estudiante, $asignaturaId): JsonResponse
    {
        $request->validate([
            'notaFinal' => 'required|numeric|between:0,5',
            'estado' => 'required|in:aprobado,reprobado'
        ]);

        $estudiante->asignaturas()->updateExistingPivot($asignaturaId, [
            'notaFinal' => $request->notaFinal,
            'estado' => $request->estado
        ]);

        return response()->json(['message' => 'Calificación registrada correctamente']);
    }

    public function getHistorialAcademico(Estudiante $estudiante): JsonResponse
    {
        $historial = $estudiante->asignaturas()
            ->withPivot('semestre', 'año', 'grupo', 'notaFinal', 'estado', 'fechaMatricula')
            ->orderBy('año', 'desc')
            ->orderBy('semestre', 'desc')
            ->get();

        return response()->json($historial);
    }
}
