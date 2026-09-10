<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaCancelacionController extends Controller
{
    // Flujo "Cancela o pospone una cita": elegir cita -> ver detalle -> Eliminar o Editar hora.

    public function index()
    {
        $citas = Cita::with(['barbero', 'servicio'])
            ->whereDate('fecha', now()->toDateString())
            ->whereIn('estado', ['pendiente', 'atendiendo'])
            ->orderBy('hora')
            ->get();

        return view('citas.cancelar-index', compact('citas'));
    }

    public function confirmarSeleccion(Request $request)
    {
        $datos = $request->validate([
            'cita_id' => 'required|exists:citas,id',
        ]);

        return redirect()->route('citas.cancelar.mostrar', $datos['cita_id']);
    }

    public function mostrar(Cita $cita)
    {
        $cita->load(['barbero', 'servicio']);

        return view('citas.cancelar-mostrar', compact('cita'));
    }

    public function eliminar(Cita $cita)
    {
        $cita->update(['estado' => 'cancelada']);

        return redirect()->route('agenda.index')->with('exito', 'Cita cancelada.');
    }

    public function editar(Cita $cita)
    {
        $cita->load('servicio');

        return view('citas.cancelar-editar', compact('cita'));
    }

    public function actualizar(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'hora' => 'required',
        ]);

        $cita->update(['hora' => $datos['hora']]);

        return redirect()->route('agenda.index')->with('exito', 'Cita actualizada.');
    }
}
