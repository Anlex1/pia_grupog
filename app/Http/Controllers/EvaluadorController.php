<?php

namespace App\Http\Controllers;

use App\Models\Evaluador;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EvaluadorController extends Controller
{
    // Obtener todos los evaluadores
    public function index(): JsonResponse
    {
        $evaluadores = Evaluador::with('evaluaciones')->get();
        return response()->json($evaluadores);
    }

    // Crear un nuevo evaluador
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:evaluadores,identificacion',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:evaluadores,email',
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:100',
        ]);

        $evaluador = Evaluador::create($request->only([
            'identificacion',
            'nombres',
            'apellidos',
            'email',
            'telefono',
            'especialidad',
        ]));

        return response()->json($evaluador, 201);
    }

    // Mostrar un evaluador específico
    public function show(Evaluador $evaluador): JsonResponse
    {
        $evaluador->load('evaluaciones');
        return response()->json($evaluador);
    }

    // Actualizar un evaluador
    public function update(Request $request, Evaluador $evaluador): JsonResponse
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:evaluadores,identificacion,' . $evaluador->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:evaluadores,email,' . $evaluador->id,
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:100',
        ]);

        $evaluador->update($request->only([
            'identificacion',
            'nombres',
            'apellidos',
            'email',
            'telefono',
            'especialidad',
        ]));

        return response()->json($evaluador);
    }

    // Eliminar un evaluador
    public function destroy(Evaluador $evaluador): JsonResponse
    {
        $evaluador->delete();
        return response()->json(['message' => 'Evaluador eliminado correctamente']);
    }
}
