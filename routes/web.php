<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EstudianteController;

Route::get('/', function () {
    return view('/estudiantes.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('search');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//NEW RUTAS
//Rutas de asesores y tutores
Route::resource('asesores', AsesorController::class);
Route::resource('tutores', TutorController::class);

//Rutas de temas
Route::resource('temas', TemaController::class);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/tema/{id}', [TemaController::class, 'detalle'])->name('tema.detalle');
Route::get('/temas/{tema}/asignarshow', [TemaController::class, 'asignarshow'])->name('temas.asignarshow');

//Rutas de estudiantes
Route::resource('estudiantes', EstudianteController::class);

// Rutas para asignar/desasignar y cambiar estado de temas
Route::get('temas/{id}/asignar', [TemaController::class, 'asignarEstudianteForm'])->name('temas.asignarEstudianteForm');
Route::post('temas/{id}/asignar', [TemaController::class, 'asignarEstudiante'])->name('temas.asignarEstudiante');
Route::post('temas/{id}/desasignar', [TemaController::class, 'desasignarEstudiante'])->name('temas.desasignar');
Route::post('temas/{id}/aprobarPerfil', [TemaController::class, 'aprobarPerfil'])->name('temas.aprobarPerfil');
Route::post('temas/{id}/proyectoTerminado', [TemaController::class, 'proyectoTerminado'])->name('temas.proyectoTerminado');
