<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo_pagina', 'Barberia')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    {{-- GRID: estructura general de la pantalla (header / contenido / acciones / nav) --}}
    <div class="pantalla">
        @yield('contenido')

        {{-- Parcial estatico reutilizado en TODAS las pantallas de la app --}}
        @include('layouts._partials.nav-inferior')
    </div>
</body>
</html>
