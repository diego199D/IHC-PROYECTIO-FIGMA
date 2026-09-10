<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Producto;
use Illuminate\Http\Request;

class AtencionController extends Controller
{
    // Flujo "Atendiendo al cliente": agregar consumo (bebidas/productos) y cobrar.

    public function mostrar(Cita $cita)
    {
        if ($cita->estado === 'pendiente') {
            $cita->update(['estado' => 'atendiendo']);
        }

        $cita->load(['barbero', 'servicio', 'extras.producto']);

        return view('atencion.mostrar', compact('cita'));
    }

    public function bebidas(Cita $cita)
    {
        $bebidas = Producto::where('tipo', 'bebida')->orderBy('nombre')->get();

        return view('atencion.bebidas', compact('cita', 'bebidas'));
    }

    public function agregarBebida(Request $request, Cita $cita)
    {
        return $this->agregarProductoACita($request, $cita, 'atencion.bebidas');
    }

    public function productos(Cita $cita)
    {
        $productos = Producto::where('tipo', 'producto')->orderBy('nombre')->get();

        return view('atencion.productos', compact('cita', 'productos'));
    }

    public function agregarProducto(Request $request, Cita $cita)
    {
        return $this->agregarProductoACita($request, $cita, 'atencion.productos');
    }

    private function agregarProductoACita(Request $request, Cita $cita, string $rutaVolver)
    {
        $datos = $request->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);

        $producto = Producto::findOrFail($datos['producto_id']);

        $cita->extras()->create([
            'producto_id' => $producto->id,
            'precio' => $producto->precio,
        ]);

        return redirect()->route('atencion.mostrar', $cita)->with('exito', 'Extra agregado.');
    }

    public function cobrar(Cita $cita)
    {
        $cita->load(['barbero', 'servicio', 'extras.producto']);

        return view('atencion.cobrar', compact('cita'));
    }

    public function despachar(Cita $cita)
    {
        $cita->update(['estado' => 'cobrada']);

        return redirect()->route('agenda.index')->with('exito', 'Cliente despachado y cobrado.');
    }
}
