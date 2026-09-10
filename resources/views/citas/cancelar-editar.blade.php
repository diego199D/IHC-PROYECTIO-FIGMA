@extends('layouts.app')

@section('titulo_pagina', 'Cancela o pospone una cita')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Cancela o pospone una cita', 'subtitulo' => 'Edita la hora', 'volver' => route('citas.cancelar.mostrar', $cita)])

    <form method="POST" action="{{ route('citas.cancelar.actualizar', $cita) }}">
        @csrf
        @method('PUT')

        <div class="contenido">
            <div class="lista-tarjetas">
                {{-- COMPONENTE REUTILIZADO: fila-seleccionable en modo soloLectura (fila "persona") --}}
                @include('_components.fila-seleccionable', [
                    'emoji' => '👤',
                    'titulo' => $cita->barbero->nombre,
                    'soloLectura' => true,
                ])
            </div>

            <div class="formulario">
                <div class="campo">
                    <label class="campo__etiqueta">Nueva hora:</label>
                    <input type="time" name="hora" value="{{ $cita->hora }}" class="campo__input" required>
                    @error('hora')
                        <span class="campo__error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label class="campo__etiqueta">Servicio:</label>
                    <input type="text" value="{{ $cita->servicio->emoji }} {{ $cita->servicio->nombre }}" class="campo__input" disabled>
                </div>
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Guardar'])
        </div>
    </form>
@endsection
