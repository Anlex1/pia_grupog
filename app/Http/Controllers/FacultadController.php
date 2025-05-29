<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FacultadController extends Controller
{
    public function index(): JsonResponse
    {
        $facultades = Facultad::with('institucion', 'departamentos')->get();
        return response()->json($facultades);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'institucionId' => 'required|exists:instituciones,id'
        ]);

        $facultad = Facultad::create($request->all());
        $facultad->load('institucion');
        return response()->json($facultad, 201);
    }

    public function show(Facultad $facultad): JsonResponse
    {
        $facultad->load('institucion', 'departamentos.programas');
        return response()->json($facultad);
    }

    public function update(Request $request, Facultad $facultad): JsonResponse
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'institucionId' => 'required|exists:instituciones,id'
        ]);

        $facultad->update($request->all());
        $facultad->load('institucion');
        return response()->json($facultad);
    }

    public function destroy(Facultad $facultad): JsonResponse
    {
        $facultad->delete();
        return response()->json(['message' => 'Facultad eliminada correctamente']);
    }

    public function getByInstitucion(Institucion $institucion): JsonResponse
    {
        $facultades = $institucion->facultades()->with('departamentos')->get();
        return response()->json($facultades);
    }
}