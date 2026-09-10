@extends('layouts.app')

@section('titulo_pagina', 'Agrega una cita')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Agrega una cita', 'subtitulo' => 'Completa los pasos para agendar', 'volver' => route('citas.crear.barbero')])

    <form method="POST" action="{{ route('citas.crear.servicio.guardar') }}">
        @csrf

        <div class="contenido">
            <div class="lista-tarjetas">
                @foreach ($servicios as $servicio)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable (fila "servicio" del Figma) --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => $servicio->emoji,
                        'titulo' => $servicio->nombre,
                        'subtitulo' => $servicio->duracion_minutos.' min',
                        'precio' => 'Bs. '.number_format($servicio->precio, 0),
                        'nombreInput' => 'servicio_id',
                        'valor' => $servicio->id,
                        'seleccionado' => (string) $seleccionado === (string) $servicio->id,
                    ])
                @endforeach
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Siguiente'])
        </div>
    </form>
@endsection
