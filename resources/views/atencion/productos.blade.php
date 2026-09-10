@extends('layouts.app')

@section('titulo_pagina', 'Productos disponibles')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Productos disponibles', 'subtitulo' => 'Agrega productos al cliente', 'volver' => route('atencion.mostrar', $cita)])

    <form method="POST" action="{{ route('atencion.productos.agregar', $cita) }}">
        @csrf

        <div class="contenido">
            <div class="lista-tarjetas">
                @foreach ($productos as $producto)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable (fila "bebida/producto" del Figma) --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => $producto->emoji,
                        'titulo' => $producto->nombre,
                        'precio' => 'Bs. '.number_format($producto->precio, 0),
                        'nombreInput' => 'producto_id',
                        'valor' => $producto->id,
                    ])
                @endforeach
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Añadir'])
        </div>
    </form>
@endsection
