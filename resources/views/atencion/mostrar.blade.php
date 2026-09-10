@extends('layouts.app')

@section('titulo_pagina', 'Atendiendo al cliente')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Atendiendo al cliente', 'subtitulo' => 'Puedes agregar consumo o productos mejorados', 'volver' => route('agenda.index')])

    <div class="contenido">
        @if (session('exito'))
            <p class="mensaje-flash mensaje-flash--exito">{{ session('exito') }}</p>
        @endif

        <div class="lista-tarjetas">
            {{-- COMPONENTE REUTILIZADO: fila-cita-activa, con boton "COBRAR" hacia atencion.cobrar --}}
            @include('_components.fila-cita-activa', [
                'hora' => \Illuminate\Support\Carbon::parse($cita->hora)->format('g:i A'),
                'cliente' => $cita->cliente_nombre,
                'servicioTexto' => $cita->servicio->emoji.' '.$cita->servicio->nombre,
                'boton' => 'COBRAR',
                'rutaBoton' => route('atencion.cobrar', $cita),
            ])
        </div>

        @if ($cita->extras->isNotEmpty())
            <p class="titulo-seccion">Extras:</p>
            <div class="lista-tarjetas">
                @foreach ($cita->extras as $extra)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura (bebida/producto) --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => $extra->producto->emoji,
                        'titulo' => $extra->producto->nombre,
                        'precio' => 'Bs. '.number_format($extra->precio, 0),
                        'soloLectura' => true,
                    ])
                @endforeach
            </div>
        @endif
    </div>

    <div class="acciones">
        @include('_components.boton', ['texto' => '+ Consumo', 'tipo' => 'link', 'href' => route('atencion.bebidas', $cita)])
        @include('_components.boton', ['texto' => '+ Producto', 'tipo' => 'link', 'href' => route('atencion.productos', $cita)])
    </div>
@endsection
