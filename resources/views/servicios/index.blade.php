@extends('layouts.app')

@section('titulo_pagina', 'Edita o agrega servicios')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Edita o agrega servicios', 'subtitulo' => 'Edita o agrega nuevos servicios a la barberia'])

    <form method="POST" action="{{ route('servicios.buscar-editar') }}">
        @csrf

        <div class="contenido">
            @if (session('exito'))
                <p class="mensaje-flash mensaje-flash--exito">{{ session('exito') }}</p>
            @endif

            <div class="lista-tarjetas">
                @foreach ($servicios as $servicio)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable (fila "servicio" del Figma) --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => $servicio->emoji,
                        'titulo' => $servicio->nombre,
                        'subtitulo' => $servicio->duracion_minutos ? $servicio->duracion_minutos.' min' : null,
                        'precio' => 'Bs. '.number_format($servicio->precio, 0),
                        'nombreInput' => 'servicio_id',
                        'valor' => $servicio->id,
                    ])
                @endforeach
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => '+ Promocion', 'tipo' => 'link', 'href' => route('servicios.promociones.crear')])
            @include('_components.boton', ['texto' => 'Editar'])
        </div>
    </form>
@endsection
