<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    // Flujo "Edita o agrega servicios": lista -> Editar servicio, o +Promocion -> crear promocion.

    public function index()
    {
        $servicios = Servicio::orderBy('nombre')->get();

        return view('servicios.index', compact('servicios'));
    }

    // Recibe el servicio elegido (tarjeta seleccionada) y redirige a su formulario de edicion.
    public function buscarEditar(Request $request)
    {
        $datos = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        return redirect()->route('servicios.edit', $datos['servicio_id']);
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.editar', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'emoji' => 'required|string|max:10',
        ]);

        $servicio->update($datos);

        return redirect()->route('servicios.index')->with('exito', 'Servicio actualizado.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')->with('exito', 'Servicio eliminado.');
    }

    public function crearPromocion()
    {
        $servicios = Servicio::where('es_promocion', false)->orderBy('nombre')->get();

        return view('servicios.crear-promocion', compact('servicios'));
    }

    public function guardarPromocion(Request $request)
    {
        $datos = $request->validate([
            'servicios' => 'required|array|size:2',
            'servicios.*' => 'exists:servicios,id',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'emoji' => 'required|string|max:10',
        ]);

        $promocion = Servicio::create([
            'nombre' => $datos['nombre'],
            'precio' => $datos['precio'],
            'emoji' => $datos['emoji'],
            'es_promocion' => true,
        ]);

        $promocion->serviciosIncluidos()->attach($datos['servicios']);

        return redirect()->route('servicios.index')->with('exito', 'Promocion guardada.');
    }
}
