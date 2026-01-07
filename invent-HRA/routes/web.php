<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Rutas específicas (deben ir antes del resource para evitar conflictos)
Route::get('equipos/search', [EquipoController::class, 'search'])->name('equipos.search');

//Ruta para reportes
Route::get('reportes', [ReportesController::class, 'index'])->name('reportes.index');

// Ruta para ver equipos por tipo (nombre)
Route::get('/equipos/tipos', [EquipoController::class, 'porEquipos'])->name('equipos.por_tipo');
Route::get('/equipos/existencias', [EquipoController::class, 'porExistencias'])->name('equipos.por_existencias');

Route::get('/equipos/tipo/{nombreEquipo}', [EquipoController::class, 'detalleEquipo'])->name('equipos.detalle_tipo');

// Rutas para el CRUD de equipos
Route::resource('equipos', EquipoController::class);


Route::get('/test-update/{id}', function($id) {
    $equipo = \App\Models\Equipo::find($id);
    
    if (!$equipo) {
        return "Equipo no encontrado";
    }
    
    // Simular request
    $request = new \Illuminate\Http\Request([
        'fecha_ingreso' => '2024-01-01',
        'cantidad' => 1,
        'equipo' => 'TEST',
        'responsable' => 'TEST',
        'departamento' => 'TI',
        'sucursal' => 'Central',
        'categoria' => 'Computadoras',
        'condicion' => 'Bueno',
        'estado' => 'Activo',
    ]);
    
    $controller = new \App\Http\Controllers\EquipoController();
    
    try {
        $response = $controller->update($request, $equipo);
        return "Update ejecutado";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});