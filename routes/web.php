<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AtencionController;
use App\Http\Controllers\CitaCancelacionController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;

// La pantalla de inicio de la app es la Agenda de hoy.
Route::get('/', fn () => redirect()->route('agenda.index'));

// ---- Flujo 1: Agenda / Agregar cita ----
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

Route::get('/citas/agregar/barbero', [CitaController::class, 'pasoBarbero'])->name('citas.crear.barbero');
Route::post('/citas/agregar/barbero', [CitaController::class, 'guardarBarbero'])->name('citas.crear.barbero.guardar');
Route::get('/citas/agregar/servicio', [CitaController::class, 'pasoServicio'])->name('citas.crear.servicio');
Route::post('/citas/agregar/servicio', [CitaController::class, 'guardarServicio'])->name('citas.crear.servicio.guardar');
Route::get('/citas/agregar/hora', [CitaController::class, 'pasoHora'])->name('citas.crear.hora');
Route::post('/citas/agregar/hora', [CitaController::class, 'confirmar'])->name('citas.crear.confirmar');

// ---- Flujo 2: Cancelar o posponer una cita ----
Route::get('/citas/cancelar', [CitaCancelacionController::class, 'index'])->name('citas.cancelar.index');
Route::post('/citas/cancelar', [CitaCancelacionController::class, 'confirmarSeleccion'])->name('citas.cancelar.confirmar');
Route::get('/citas/cancelar/{cita}', [CitaCancelacionController::class, 'mostrar'])->name('citas.cancelar.mostrar');
Route::delete('/citas/cancelar/{cita}', [CitaCancelacionController::class, 'eliminar'])->name('citas.cancelar.eliminar');
Route::get('/citas/cancelar/{cita}/editar', [CitaCancelacionController::class, 'editar'])->name('citas.cancelar.editar');
Route::put('/citas/cancelar/{cita}', [CitaCancelacionController::class, 'actualizar'])->name('citas.cancelar.actualizar');

// ---- Flujo 3: Editar / agregar servicios y promociones ----
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::post('/servicios/buscar-editar', [ServicioController::class, 'buscarEditar'])->name('servicios.buscar-editar');
Route::get('/servicios/{servicio}/editar', [ServicioController::class, 'edit'])->name('servicios.edit');
Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
Route::get('/servicios/promociones/crear', [ServicioController::class, 'crearPromocion'])->name('servicios.promociones.crear');
Route::post('/servicios/promociones', [ServicioController::class, 'guardarPromocion'])->name('servicios.promociones.guardar');

// ---- Flujo 4: Atender cliente / agregar consumo / cobrar ----
Route::get('/citas/{cita}/atender', [AtencionController::class, 'mostrar'])->name('atencion.mostrar');
Route::get('/citas/{cita}/consumo/bebidas', [AtencionController::class, 'bebidas'])->name('atencion.bebidas');
Route::post('/citas/{cita}/consumo/bebidas', [AtencionController::class, 'agregarBebida'])->name('atencion.bebidas.agregar');
Route::get('/citas/{cita}/consumo/productos', [AtencionController::class, 'productos'])->name('atencion.productos');
Route::post('/citas/{cita}/consumo/productos', [AtencionController::class, 'agregarProducto'])->name('atencion.productos.agregar');
Route::get('/citas/{cita}/cobrar', [AtencionController::class, 'cobrar'])->name('atencion.cobrar');
Route::post('/citas/{cita}/despachar', [AtencionController::class, 'despachar'])->name('atencion.despachar');
