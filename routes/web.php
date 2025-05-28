<?php

use App\Http\Controllers\{ 
    InstitucionController, FacultadController, DepartamentoController, ProgramaController, AsignaturaController,
    DocenteController, EstudianteController, EvaluadorController,
    ProyectoController, TipoProyectoController, EvaluacionController,
    UsuarioController, RolController, PermisoController, ProfileController
};

use Illuminate\Support\Facades\Route;

Route::resources([
    'instituciones' => InstitucionController::class,
    'facultades' => FacultadController::class,
    'departamentos' => DepartamentoController::class,
    'programas' => ProgramaController::class,
    'asignaturas' => AsignaturaController::class,

    'docentes' => DocenteController::class,
    'estudiantes' => EstudianteController::class,
    'evaluadores' => EvaluadorController::class,

    'tipos-proyecto' => TipoProyectoController::class,
    'proyectos' => ProyectoController::class,
    'evaluaciones' => EvaluacionController::class,

    'usuarios' => UsuarioController::class,
    'roles' => RolController::class,
    'permisos' => PermisoController::class,
]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Rutas de CRUD
 * Todas las opciones del Menú
 */
Route::middleware(['auth'])->group(function () {
    Route::resource('tipo-proyectos', TipoProyectoController::class);
    Route::resource('asignaturas', AsignaturaController::class);
});


require __DIR__.'/auth.php';
