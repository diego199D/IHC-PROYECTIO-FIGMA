@extends('layouts.app')

@section('titulo_pagina', 'Edita o agrega servicios')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Edita o agrega servicios', 'subtitulo' => 'Edita o agrega nuevos servicios a la barberia', 'volver' => route('servicios.index')])

    <div class="contenido">
        <div class="lista-tarjetas">
            {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura, muestra el servicio elegido --}}
            @include('_components.fila-seleccionable', [
                'emoji' => $servicio->emoji,
                'titulo' => $servicio->nombre,
                'subtitulo' => $servicio->duracion_minutos ? $servicio->duracion_minutos.' min' : null,
                'precio' => 'Bs. '.number_format($servicio->precio, 0),
                'soloLectura' => true,
            ])
        </div>

        {{-- Los campos usan el atributo "form" para enviarse con el formulario "editar-servicio"
             que vive mas abajo, junto al boton "Editar", dentro de .acciones. --}}
        <div class="formulario">
            <div class="campo">
                <label class="campo__etiqueta">Nombre:</label>
                <input type="text" name="nombre" form="editar-servicio" value="{{ old('nombre', $servicio->nombre) }}" class="campo__input" required>
                @error('nombre')
                    <span class="campo__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="campo">
                <label class="campo__etiqueta">Precio:</label>
                <input type="number" step="0.01" name="precio" form="editar-servicio" value="{{ old('precio', $servicio->precio) }}" class="campo__input" required>
                @error('precio')
                    <span class="campo__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="campo">
                <label class="campo__etiqueta">Emoji:</label>
                <input type="text" name="emoji" form="editar-servicio" value="{{ old('emoji', $servicio->emoji) }}" class="campo__input" required>
                @error('emoji')
                    <span class="campo__error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="acciones">
        <form method="POST" action="{{ route('servicios.destroy', $servicio) }}">
            @csrf
            @method('DELETE')
            @include('_components.boton', ['texto' => 'Eliminar'])
        </form>
        <form id="editar-servicio" method="POST" action="{{ route('servicios.update', $servicio) }}">
            @csrf
            @method('PUT')
            @include('_components.boton', ['texto' => 'Editar'])
        </form>
    </div>
@endsection
