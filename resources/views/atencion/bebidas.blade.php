@extends('layouts.app')

@section('titulo_pagina', 'Bebidas disponibles')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Bebidas disponibles', 'subtitulo' => 'Agrega consumo al cliente', 'volver' => route('atencion.mostrar', $cita)])

    <form method="POST" action="{{ route('atencion.bebidas.agregar', $cita) }}">
        @csrf

        <div class="contenido">
            <div class="lista-tarjetas">
                @foreach ($bebidas as $bebida)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable (fila "bebida/producto" del Figma) --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => $bebida->emoji,
                        'titulo' => $bebida->nombre,
                        'precio' => 'Bs. '.number_format($bebida->precio, 0),
                        'nombreInput' => 'producto_id',
                        'valor' => $bebida->id,
                    ])
                @endforeach
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Añadir'])
        </div>
    </form>
@endsection
