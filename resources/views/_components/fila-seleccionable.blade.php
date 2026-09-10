{{--
    COMPONENTE REUTILIZABLE MAS USADO DE LA APP: fila-seleccionable.
    Es la MISMA tarjeta (emoji + texto, con estado normal/seleccionado) que
    en el Figma (figma/componentes.png) aparece para "persona" y "servicio".
    Aqui se reutiliza tal cual, cambiando solo el emoji y el texto, en:

      - citas/agregar-barbero.blade.php   (emoji persona, nombre del barbero)
      - citas/agregar-servicio.blade.php  (emoji tijera, nombre+duracion+precio)
      - citas/agregar-hora.blade.php      (emoji reloj, la hora)              <- misma tarjeta que barbero, solo cambia emoji/texto
      - citas/cancelar-index.blade.php    (emoji persona, cita pendiente)
      - servicios/index.blade.php         (emoji tijera, servicio)
      - servicios/crear-promocion.blade.php (emoji tijera, elegir 2 servicios)
      - atencion/bebidas.blade.php        (emoji bebida, precio)
      - atencion/productos.blade.php      (emoji producto, precio)
      - atencion/mostrar.blade.php        (lista de "Extras", modo soloLectura)
      - atencion/cobrar.blade.php         (resumen de cobro, modo soloLectura)

    Props:
      - emoji (string)
      - titulo (string)
      - subtitulo (string, opcional) p.ej. "30 min"
      - precio (string, opcional) p.ej. "Bs. 40"
      - nombreInput (string, opcional) name del input
      - valor (string, opcional) value del input
      - tipoInput ('radio'|'checkbox', opcional, por defecto 'radio')
      - seleccionado (bool, opcional)
      - soloLectura (bool, opcional) si es true no se puede seleccionar, solo se muestra
--}}
@php
    $seleccionado = $seleccionado ?? false;
    $soloLectura = $soloLectura ?? false;
    $tipoInput = $tipoInput ?? 'radio';
@endphp

@if ($soloLectura)
    <div class="tarjeta">
        <div class="tarjeta__info">
            <span class="tarjeta__emoji">{{ $emoji }}</span>
            <div class="tarjeta__texto">
                <span class="tarjeta__titulo">{{ $titulo }}</span>
                @isset($subtitulo)
                    <span class="tarjeta__subtitulo">{{ $subtitulo }}</span>
                @endisset
            </div>
        </div>
        @isset($precio)
            <span class="tarjeta__precio">{{ $precio }}</span>
        @endisset
    </div>
@else
    <label class="tarjeta-seleccionable">
        <input type="{{ $tipoInput }}" name="{{ $nombreInput }}" value="{{ $valor }}" @checked($seleccionado) @if ($tipoInput === 'radio') required @endif>
        <div class="tarjeta">
            <div class="tarjeta__info">
                <span class="tarjeta__emoji">{{ $emoji }}</span>
                <div class="tarjeta__texto">
                    <span class="tarjeta__titulo">{{ $titulo }}</span>
                    @isset($subtitulo)
                        <span class="tarjeta__subtitulo">{{ $subtitulo }}</span>
                    @endisset
                </div>
            </div>
            @isset($precio)
                <span class="tarjeta__precio">{{ $precio }}</span>
            @endisset
        </div>
    </label>
@endif
