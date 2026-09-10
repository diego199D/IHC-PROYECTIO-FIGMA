@extends('layouts.app')

@section('titulo_pagina', 'Edita o agrega servicios')

@section('contenido')
    @include('_components.encabezado', ['titulo' => 'Edita o agrega servicios', 'subtitulo' => 'Edita o agrega nuevos servicios a la barberia', 'volver' => route('servicios.index')])

    <form method="POST" action="{{ route('servicios.promociones.guardar') }}">
        @csrf

        <div class="contenido">
            <div class="lista-tarjetas">
                @foreach ($servicios as $servicio)
                    {{-- COMPONENTE REUTILIZADO: fila-seleccionable (fila "servicio"), aqui con
                         checkboxes en vez de radio, porque hay que elegir exactamente 2. --}}
                    @include('_components.fila-seleccionable', [
                        'emoji' => $servicio->emoji,
                        'titulo' => $servicio->nombre,
                        'subtitulo' => $servicio->duracion_minutos.' min',
                        'precio' => 'Bs. '.number_format($servicio->precio, 0),
                        'nombreInput' => 'servicios[]',
                        'valor' => $servicio->id,
                        'tipoInput' => 'checkbox',
                    ])
                @endforeach
            </div>

            <div class="formulario">
                <div class="campo">
                    <label class="campo__etiqueta">Nombre de la promocion:</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="campo__input" required>
                    @error('nombre')
                        <span class="campo__error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label class="campo__etiqueta">Precio:</label>
                    <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" class="campo__input" required>
                    @error('precio')
                        <span class="campo__error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label class="campo__etiqueta">Emoji:</label>
                    <input type="text" name="emoji" value="{{ old('emoji', '💈') }}" class="campo__input" required>
                    @error('emoji')
                        <span class="campo__error">{{ $message }}</span>
                    @enderror
                </div>
                @error('servicios')
                    <span class="campo__error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="acciones">
            @include('_components.boton', ['texto' => 'Guardar promocion'])
        </div>
    </form>
@endsection
