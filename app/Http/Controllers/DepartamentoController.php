<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DepartamentoController extends Controller
{
    public function index(): JsonResponse
    {
        $departamentos = Departamento::with('facultad.institucion', 'programas')->get();
        return response()->json($departamentos);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'facultadId' => 'required|exists:facultades,id'
        ]);

        $departamento = Departamento::create($request->all());
        $departamento->load('facultad');
        return response()->json($departamento, 201);
    }

    public function show(Departamento $departamento): JsonResponse
    {
        $departamento->load('facultad.institucion', 'programas.asignaturas');
        return response()->json($departamento);
    }

    public function update(Request $request, Departamento $departamento): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'facultadId' => 'required|exists:facultades,id'
        ]);

        $departamento->update($request->all());
        $departamento->load('facultad');
        return response()->json($departamento);
    }

    public function destroy(Departamento $departamento): JsonResponse
    {
        $departamento->delete();
        return response()->json(['message' => 'Departamento eliminado correctamente']);
    }

    public function getByFacultad(Facultad $facultad): JsonResponse
    {
        $departamentos = $facultad->departamentos()->with('programas')->get();
        return response()->json($departamentos);
    }
}