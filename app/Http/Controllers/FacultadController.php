<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use App\Models\Institucion;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facultades = Facultad::with('institucion', 'departamentos')->get();
        return view('facultades.index', compact('facultades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instituciones = Institucion::all();
        return view('facultades.create', compact('instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:10|unique:facultades,codigo',
            'descripcion' => 'required|string|max:255',
            'institucion_codigo' => 'required|exists:instituciones,codigo'
        ]);

        Facultad::create($request->all());

        return redirect()->route('facultades.index')
                        ->with('success', 'Facultad creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facultad $facultad)
    {
        $facultad->load('institucion', 'departamentos.programas');
        return view('facultades.show', compact('facultad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facultad $facultad)
    {
        $instituciones = Institucion::all();
        return view('facultades.edit', compact('facultad', 'instituciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facultad $facultad)
    {
        $request->validate([
            'codigo' => 'required|string|max:10|unique:facultades,codigo,'.$facultad->id,
            'descripcion' => 'required|string|max:255',
            'institucion_codigo' => 'required|exists:instituciones,codigo'
        ]);

        $facultad->update($request->all());

        return redirect()->route('facultades.index')
                        ->with('success', 'Facultad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facultad $facultad)
    {
        $facultad->delete();

        return redirect()->route('facultades.index')
                        ->with('success', 'Facultad eliminada correctamente');
    }

    /**
     * API: Get faculties by institution
     */
    public function getByInstitucion(Institucion $institucion): JsonResponse
    {
        $facultades = $institucion->facultades()->with('departamentos')->get();
        return response()->json($facultades);
    }
}