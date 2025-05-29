<?php

namespace App\Http\Controllers;

use App\Models\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $instituciones = Institucion::with('facultades')->get();
        return response()->json($instituciones);
    }
    
    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Facultad $facultad): JsonResponse
    {
        $facultad->load('institucion', 'departamentos.programas');
        return response()->json($facultad);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
