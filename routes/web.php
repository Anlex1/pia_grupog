<?php

use App\Http\Controllers\{ 
    InstitucionController, FacultadController, DepartamentoController, ProgramaController, AsignaturaController,
    DocenteController, EstudianteController, EvaluadorController,
    ProyectoController, TipoProyectoController, EvaluacionController,
    UsuarioController, RolController, PermisoController, ProfileController
};

use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Recursos CRUD principales
    Route::resources([
        'instituciones' => InstitucionController::class,
        'facultades' => FacultadController::class,
        'departamentos' => DepartamentoController::class,
        'programas' => ProgramaController::class,
        'asignaturas' => AsignaturaController::class,
        'docentes' => DocenteController::class,
        'estudiantes' => EstudianteController::class,
        'evaluadores' => EvaluadorController::class,
        'tipo-proyectos' => TipoProyectoController::class,
        'proyectos' => ProyectoController::class,
        'evaluaciones' => EvaluacionController::class,
        'usuarios' => UsuarioController::class,
        'roles' => RolController::class,
        'permisos' => PermisoController::class,
    ]);
    
    // Rutas API adicionales para relaciones
    Route::prefix('api')->group(function () {
        Route::get('/instituciones/{institucion}/facultades', [FacultadController::class, 'getByInstitucion']);
        Route::get('/facultades/{facultad}/departamentos', [DepartamentoController::class, 'getByFacultad']);
        // Agrega aquí otras rutas API que necesites
    });
});