<?php

namespace App\Http\Controllers;

use App\Models\Cita;

class AgendaController extends Controller
{
    // Pantalla "Agenda de hoy": lista las citas del dia que aun no fueron canceladas ni cobradas.
    public function index()
    {
        $citas = Cita::with(['barbero', 'servicio'])
            ->whereDate('fecha', now()->toDateString())
            ->whereIn('estado', ['pendiente', 'atendiendo'])
            ->orderBy('hora')
            ->get();

        // "martes, 8 de septiembre" (como en el Figma)
        $fechaTexto = now()->locale('es')->isoFormat('dddd, D [de] MMMM');

        return view('agenda.index', compact('citas', 'fechaTexto'));
    }
}
