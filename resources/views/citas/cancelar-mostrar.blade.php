@extends('layouts.app')

@section('titulo_pagina', 'Cancela o pospone una cita')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Cancela o pospone una cita', 'subtitulo' => 'Completa los pasos para agendar', 'volver' => route('citas.cancelar.index')])

    <div class="contenido">
        <div class="lista-tarjetas">
            {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura (fila "persona") --}}
            @include('_components.fila-seleccionable', [
                'emoji' => '👤',
                'titulo' => $cita->barbero->nombre,
                'soloLectura' => true,
            ])
            {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura (fila "servicio") --}}
            @include('_components.fila-seleccionable', [
                'emoji' => $cita->servicio->emoji,
                'titulo' => $cita->servicio->nombre,
                'subtitulo' => $cita->servicio->duracion_minutos.' min',
                'precio' => 'Bs. '.number_format($cita->servicio->precio, 0),
                'soloLectura' => true,
            ])
            {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura (fila "hora") --}}
            @include('_components.fila-seleccionable', [
                'emoji' => '🕐',
                'titulo' => \Illuminate\Support\Carbon::parse($cita->hora)->format('g:i A'),
                'soloLectura' => true,
            ])
        </div>
    </div>

    <div class="acciones">
        <form method="POST" action="{{ route('citas.cancelar.eliminar', $cita) }}">
            @csrf
            @method('DELETE')
            @include('_components.boton', ['texto' => 'Eliminar'])
        </form>
        @include('_components.boton', ['texto' => 'Editar', 'tipo' => 'link', 'href' => route('citas.cancelar.editar', $cita)])
    </div>
@endsection
