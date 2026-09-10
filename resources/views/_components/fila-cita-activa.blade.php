{{--
    COMPONENTE REUTILIZABLE: fila-cita-activa (4ta fila de figma/componentes.png).
    Se reutiliza en:
      - agenda/index.blade.php   (sin boton, solo informativa)
      - atencion/mostrar.blade.php (con boton "COBRAR" que lleva a atencion.cobrar)

    Props:
      - hora (string)
      - cliente (string)
      - servicioTexto (string) ya con su emoji, p.ej. "✂️ Afeitado"
      - boton (string, opcional) texto del boton, p.ej. "COBRAR"
      - rutaBoton (string, opcional) href del boton
--}}
<div class="cita-activa">
    <div class="cita-activa__datos">
        <span class="cita-activa__hora">{{ $hora }}</span>
        <span class="cita-activa__cliente">{{ $cliente }}</span>
        <span class="cita-activa__servicio">{{ $servicioTexto }}</span>
    </div>
    @isset($boton)
        @include('_components.boton', ['texto' => $boton, 'tipo' => 'link', 'href' => $rutaBoton, 'class' => 'boton--pequeno'])
    @endisset
</div>
