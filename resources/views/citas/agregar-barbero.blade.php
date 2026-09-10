@extends('layouts.app')

@section('titulo_pagina', 'Agrega una cita')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Agrega una cita', 'subtitulo' => 'Completa los pasos para agendar', 'volver' => route('agenda.index')])

    <form method="POST" action="{{ route('citas.crear.barbero.guardar') }}">
        @csrf

        <div class="contenido">
            {{-- GRID: lista de barberos, uno debajo del otro --}}
            <div class="lista-tarjetas">
                @foreach ($barberos as $barbero)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable (fila "persona" del Figma) --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => '👤',
                        'titulo' => $barbero->nombre,
                        'nombreInput' => 'barbero_id',
                        'valor' => $barbero->id,
                        'seleccionado' => (string) $seleccionado === (string) $barbero->id,
                    ])
                @endforeach
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Siguiente'])
        </div>
    </form>
@endsection
