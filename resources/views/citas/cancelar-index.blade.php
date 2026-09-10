@extends('layouts.app')

@section('titulo_pagina', 'Cancela o pospone una cita')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Cancela o pospone una cita', 'subtitulo' => 'Completa los pasos para agendar', 'volver' => route('agenda.index')])

    <form method="POST" action="{{ route('citas.cancelar.confirmar') }}">
        @csrf

        <div class="contenido">
            <div class="lista-tarjetas">
                @forelse ($citas as $cita)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable (fila "persona" del Figma).
                         Cada fila representa una cita pendiente de hoy. --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => '👤',
                        'titulo' => $cita->barbero->nombre,
                        'subtitulo' => \Illuminate\Support\Carbon::parse($cita->hora)->format('g:i A').' · '.$cita->cliente_nombre,
                        'nombreInput' => 'cita_id',
                        'valor' => $cita->id,
                    ])
                @empty
                    <p class="contenido__vacio">No hay citas para cancelar o posponer.</p>
                @endforelse
            </div>
        </div>

        @if ($citas->isNotEmpty())
            <div class="acciones">
                @include('_components.boton', ['texto' => 'Confirmar'])
            </div>
        @endif
    </form>
@endsection
