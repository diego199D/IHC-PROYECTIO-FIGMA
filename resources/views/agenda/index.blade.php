@extends('layouts.app')

@section('titulo_pagina', 'Agenda de hoy')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Agenda de hoy', 'subtitulo' => $fechaTexto])

    <div class="contenido">
        @if (session('exito'))
            <p class="mensaje-flash mensaje-flash--exito">{{ session('exito') }}</p>
        @endif

        {{-- GRID: lista de citas del dia, apiladas en una columna --}}
        <div class="lista-tarjetas">
            @forelse ($citas as $cita)
                {{-- COMPONENTE REUTILIZADO: fila-cita-activa (sin boton, solo informativa).
                     Toda la fila es clicable y lleva a "Atendiendo al cliente" (flujo 4). --}}
                <a href="{{ route('atencion.mostrar', $cita) }}">
                    @include('_components.fila-cita-activa', [
                        'hora' => \Illuminate\Support\Carbon::parse($cita->hora)->format('g:i A'),
                        'cliente' => $cita->cliente_nombre,
                        'servicioTexto' => $cita->servicio->emoji.' '.$cita->servicio->nombre,
                    ])
                </a>
            @empty
                <p class="contenido__vacio">No hay citas agendadas para hoy.</p>
            @endforelse
        </div>
    </div>

    <div class="acciones">
        {{-- Boton reutilizado: lleva al flujo 2 (cancelar/posponer) --}}
        @include('_components.boton', ['texto' => 'Cancelar Cita', 'tipo' => 'link', 'href' => route('citas.cancelar.index')])
        {{-- Boton reutilizado: lleva al flujo 1 (wizard de agregar cita) --}}
        @include('_components.boton', ['texto' => 'Agregar Cita', 'tipo' => 'link', 'href' => route('citas.crear.barbero')])
    </div>
@endsection
