@extends('layouts.app')

@section('titulo_pagina', 'Agrega una cita')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Agrega una cita', 'subtitulo' => 'Completa los pasos para agendar', 'volver' => route('citas.crear.servicio')])

    <form method="POST" action="{{ route('citas.crear.confirmar') }}">
        @csrf

        <div class="contenido">
            <div class="lista-tarjetas">
                @foreach ($horas as $hora)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable, MISMA tarjeta que se usa
                         para barberos, solo cambiando el emoji (reloj) y el texto (la hora). --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => '🕐',
                        'titulo' => \Illuminate\Support\Carbon::createFromFormat('H:i', $hora)->format('g:i A'),
                        'nombreInput' => 'hora',
                        'valor' => $hora,
                        'seleccionado' => $seleccionada === $hora,
                    ])
                @endforeach
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Confirmar'])
        </div>
    </form>
@endsection
