<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Wizard "Agrega una cita": barbero -> servicio -> hora -> confirmar.
    // Las respuestas de cada paso se guardan en sesion hasta el paso final.

    public function pasoBarbero()
    {
        $barberos = Barbero::where('activo', true)->orderBy('nombre')->get();
        $seleccionado = session('nueva_cita.barbero_id');

        return view('citas.agregar-barbero', compact('barberos', 'seleccionado'));
    }

    public function guardarBarbero(Request $request)
    {
        $datos = $request->validate([
            'barbero_id' => 'required|exists:barberos,id',
        ]);

        session(['nueva_cita.barbero_id' => $datos['barbero_id']]);

        return redirect()->route('citas.crear.servicio');
    }

    public function pasoServicio()
    {
        $servicios = Servicio::where('es_promocion', false)->orderBy('nombre')->get();
        $seleccionado = session('nueva_cita.servicio_id');

        return view('citas.agregar-servicio', compact('servicios', 'seleccionado'));
    }

    public function guardarServicio(Request $request)
    {
        $datos = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        session(['nueva_cita.servicio_id' => $datos['servicio_id']]);

        return redirect()->route('citas.crear.hora');
    }

    public function pasoHora()
    {
        // Horarios de ejemplo disponibles para agendar (cada 30 minutos, jornada de la manana).
        $horas = ['09:00', '09:30', '10:00', '10:30', '11:00'];
        $seleccionada = session('nueva_cita.hora');

        return view('citas.agregar-hora', compact('horas', 'seleccionada'));
    }

    public function confirmar(Request $request)
    {
        $datos = $request->validate([
            'hora' => 'required',
        ]);

        Cita::create([
            'barbero_id' => session('nueva_cita.barbero_id'),
            'servicio_id' => session('nueva_cita.servicio_id'),
            'fecha' => now()->toDateString(),
            'hora' => $datos['hora'],
            'estado' => 'pendiente',
        ]);

        session()->forget('nueva_cita');

        return redirect()->route('agenda.index')->with('exito', 'Cita agregada correctamente.');
    }
}
