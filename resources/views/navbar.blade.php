
<nav>
    @if (Auth::check()) 
    <p>Has hecho login como {{ Auth::user()->name}}</p>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        this.closest('form').submit();">
        {{ __('Log Out') }}
    </a>
</form>  
@else
<a href="{{ route('login') }}">Login</a>
&nbsp;&nbsp;&nbsp;
<a href="{{ route('register') }}">Registrarse</a>
@endif
<br>
    <a href="{{ route('home') }}">Inicio</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('cuenta_list') }}">Cuentas</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('cliente_list') }}">Clientes</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('estadisticas_list') }}">Estadisticas</a>
    &nbsp;&nbsp;&nbsp;

</nav>