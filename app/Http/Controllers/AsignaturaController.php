<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AsignaturaController extends Controller
{
    public function index(): JsonResponse
    {
        $asignaturas = Asignatura::with('programa.departamento.facultad')->get();
        return response()->json($asignaturas);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'creditos' => 'nullable|integer|min:1',
            'programaId' => 'required|exists:programas,id'
        ]);

        $asignatura = Asignatura::create($request->all());
        $asignatura->load('programa');
        return response()->json($asignatura, 201);
    }

    public function show(Asignatura $asignatura): JsonResponse
    {
        $asignatura->load([
            'programa.departamento.facultad',
            'docentes',
            'estudiantes' => function($query) {
                $query->withPivot('semestre', 'año', 'grupo', 'notaFinal', 'estado');
            }
        ]);
        return response()->json($asignatura);
    }

    public function update(Request $request, Asignatura $asignatura): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'creditos' => 'nullable|integer|min:1',
            'programaId' => 'required|exists:programas,id'
        ]);

        $asignatura->update($request->all());
        $asignatura->load('programa');
        return response()->json($asignatura);
    }

    public function destroy(Asignatura $asignatura): JsonResponse
    {
        $asignatura->delete();
        return response()->json(['message' => 'Asignatura eliminada correctamente']);
    }

    public function getByPrograma(Programa $programa): JsonResponse
    {
        $asignaturas = $programa->asignaturas()->with('docentes', 'estudiantes')->get();
        return response()->json($asignaturas);
    }

    public function getEstudiantes(Asignatura $asignatura): JsonResponse
    {
        $estudiantes = $asignatura->estudiantes()
            ->withPivot('semestre', 'año', 'grupo', 'notaFinal', 'estado', 'fechaMatricula')
            ->get();
        return response()->json($estudiantes);
    }
}
