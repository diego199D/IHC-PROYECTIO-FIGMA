@extends('layouts.app')

@section('titulo_pagina', 'Cobrando al cliente')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Cobrando al cliente', 'subtitulo' => 'Agrega productos al cliente', 'volver' => route('atencion.mostrar', $cita)])

    <form method="POST" action="{{ route('atencion.despachar', $cita) }}">
        @csrf

        <div class="contenido">
            <div class="lista-tarjetas">
                {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura, el servicio de la cita --}}
                @include('_components.fila-seleccionable', [
                    'emoji' => $cita->servicio->emoji,
                    'titulo' => $cita->servicio->nombre,
                    'precio' => 'Bs. '.number_format($cita->servicio->precio, 0),
                    'soloLectura' => true,
                ])
                @foreach ($cita->extras as $extra)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura, cada extra agregado --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => $extra->producto->emoji,
                        'titulo' => $extra->producto->nombre,
                        'precio' => 'Bs. '.number_format($extra->precio, 0),
                        'soloLectura' => true,
                    ])
                @endforeach
            </div>

            <p class="titulo-seccion">Total: Bs. {{ number_format($cita->total, 0) }}</p>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Despachar'])
        </div>
    </form>
@endsection
