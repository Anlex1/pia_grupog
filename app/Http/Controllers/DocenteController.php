<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DocenteController extends Controller
{
    public function index(): JsonResponse
    {
        $docentes = Docente::with('programa.departamento.facultad')->get();
        return response()->json($docentes);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:docentes',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:docentes',
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id'
        ]);

        $docente = Docente::create($request->all());
        $docente->load('programa');
        return response()->json($docente, 201);
    }

    public function show(Docente $docente): JsonResponse
    {
        $docente->load([
            'programa.departamento.facultad',
            'asignaturas' => function($query) {
                $query->withPivot('fechaAsignacion', 'activo');
            }
        ]);
        return response()->json($docente);
    }

    public function update(Request $request, Docente $docente): JsonResponse
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:docentes,identificacion,' . $docente->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:docentes,email,' . $docente->id,
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id'
        ]);

        $docente->update($request->all());
        $docente->load('programa');
        return response()->json($docente);
    }

    public function destroy(Docente $docente): JsonResponse
    {
        $docente->delete();
        return response()->json(['message' => 'Docente eliminado correctamente']);
    }

    public function asignarAsignatura(Request $request, Docente $docente): JsonResponse
    {
        $request->validate([
            'asignaturaId' => 'required|exists:asignaturas,id',
            'fechaAsignacion' => 'nullable|date'
        ]);

        $docente->asignaturas()->attach($request->asignaturaId, [
            'fechaAsignacion' => $request->fechaAsignacion ?? now(),
            'activo' => true
        ]);

        return response()->json(['message' => 'Asignatura asignada correctamente']);
    }

    public function desasignarAsignatura(Docente $docente, $asignaturaId): JsonResponse
    {
        $docente->asignaturas()->updateExistingPivot($asignaturaId, ['activo' => false]);
        return response()->json(['message' => 'Asignatura desasignada correctamente']);
    }
}
