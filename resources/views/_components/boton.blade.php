{{--
    COMPONENTE REUTILIZABLE: boton unico de la app (pastilla verde).
    Se usa en TODOS los CTA: Agregar/Cancelar Cita, Siguiente, Confirmar,
    Eliminar, Editar, Guardar, Guardar promocion, +Promocion, +Consumo,
    +Producto, Anadir, Despachar y COBRAR (dentro de fila-cita-activa).

    Props:
      - texto (string)
      - tipo ('submit'|'link', por defecto 'submit')
      - href (string, requerido si tipo = 'link')
--}}
@php $tipo = $tipo ?? 'submit'; @endphp

@if ($tipo === 'link')
    <a href="{{ $href }}" class="boton {{ $class ?? '' }}">{{ $texto }}</a>
@else
    <button type="submit" class="boton {{ $class ?? '' }}">{{ $texto }}</button>
@endif
