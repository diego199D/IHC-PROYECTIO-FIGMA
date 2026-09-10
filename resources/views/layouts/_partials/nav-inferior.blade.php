{{--
    Parcial estatico: navegacion inferior con "Agenda" y "Servicios".
    Se incluye UNA sola vez desde layouts/app.blade.php y por eso aparece
    automaticamente en todas las pantallas de la app.
--}}
<nav class="nav-inferior">
    <a href="{{ route('agenda.index') }}" class="nav-inferior__item">
        <span class="nav-inferior__emoji">📅</span>
        <span>Agenda</span>
    </a>
    <a href="{{ route('servicios.index') }}" class="nav-inferior__item">
        <span class="nav-inferior__emoji">✂️</span>
        <span>Servicios</span>
    </a>
</nav>
