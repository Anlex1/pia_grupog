<?php

namespace App\Http\Controllers;

use App\Models\TipoProyecto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TipoProyectoController extends Controller
{
    // Listar todos los tipos de proyecto
    public function index(): JsonResponse
    {
        $tipos = TipoProyecto::with('proyectos')->get();
        return response()->json($tipos);
    }

    // Crear un nuevo tipo de proyecto
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:tiposProyecto,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $tipo = TipoProyecto::create($request->only(['nombre', 'descripcion']));

        return response()->json($tipo, 201);
    }

    // Mostrar un tipo de proyecto específico
    public function show(TipoProyecto $tipoProyecto): JsonResponse
    {
        $tipoProyecto->load('proyectos');
        return response()->json($tipoProyecto);
    }

    // Actualizar un tipo de proyecto
    public function update(Request $request, TipoProyecto $tipoProyecto): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:tiposProyecto,nombre,' . $tipoProyecto->id,
            'descripcion' => 'nullable|string|max:255',
        ]);

        $tipoProyecto->update($request->only(['nombre', 'descripcion']));

        return response()->json($tipoProyecto);
    }

    // Eliminar un tipo de proyecto
    public function destroy(TipoProyecto $tipoProyecto): JsonResponse
    {
        $tipoProyecto->delete();
        return response()->json(['message' => 'Tipo de proyecto eliminado correctamente']);
    }
}
