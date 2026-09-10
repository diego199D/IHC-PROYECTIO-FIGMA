{{--
    COMPONENTE REUTILIZABLE: encabezado verde con flecha de volver (opcional) +
    titulo + subtitulo. Se usa en TODAS las pantallas de contenido de la app
    (agenda, wizard de citas, cancelar/posponer, servicios, promociones y
    atencion al cliente).

    Props:
      - titulo (string)
      - subtitulo (string, opcional)
      - volver (string, opcional) URL a la pantalla anterior del flujo. Si no
        se pasa, no se muestra flecha (ej. Agenda y Servicios, que son el
        inicio de cada seccion y no tienen "pantalla anterior").
--}}
<header class="encabezado">
    @isset($volver)
        <a href="{{ $volver }}" class="encabezado__volver" aria-label="Volver">←</a>
    @endisset
    <div class="encabezado__textos">
        <h1 class="encabezado__titulo">{{ $titulo }}</h1>
        @isset($subtitulo)
            <p class="encabezado__subtitulo">{{ $subtitulo }}</p>
        @endisset
    </div>
</header>
