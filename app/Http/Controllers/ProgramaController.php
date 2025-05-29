<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProgramaController extends Controller
{
    public function index(): JsonResponse
    {
        $programas = Programa::with('departamento.facultad.institucion', 'asignaturas')->get();
        return response()->json($programas);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'departamentoId' => 'required|exists:departamentos,id'
        ]);

        $programa = Programa::create($request->all());
        $programa->load('departamento');
        return response()->json($programa, 201);
    }

    public function show(Programa $programa): JsonResponse
    {
        $programa->load([
            'departamento.facultad.institucion',
            'asignaturas',
            'docentes',
            'estudiantes'
        ]);
        return response()->json($programa);
    }

    public function update(Request $request, Programa $programa): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'departamentoId' => 'required|exists:departamentos,id'
        ]);

        $programa->update($request->all());
        $programa->load('departamento');
        return response()->json($programa);
    }

    public function destroy(Programa $programa): JsonResponse
    {
        $programa->delete();
        return response()->json(['message' => 'Programa eliminado correctamente']);
    }

    public function getByDepartamento(Departamento $departamento): JsonResponse
    {
        $programas = $departamento->programas()->with('asignaturas')->get();
        return response()->json($programas);
    }
}