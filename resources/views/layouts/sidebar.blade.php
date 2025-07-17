<aside class="menu p-4 has-background-light" style="min-height: 100vh;">
    <a class="logo" href="{{ route('login') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Book Studio Logo" class="logo">
    </a>
    <p class="menu-label">
        Geral
    </p>
    <ul class="menu-list">
        <li><a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'is-active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('dashboard') }}">Agendamentos</a></li>
        <li><a href="{{ route('dashboard') }}">Estúdios</a></li>
        <li><a href="{{ route('dashboard') }}">Salas</a></li>
    </ul>

    @if (auth()->user()->role->name === 'admin')
        <p class="menu-label mt-4">
            Administração
        </p>
        <ul class="menu-list">
            <li><a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.create') ? 'is-active' : '' }}">Usuários</a></li>
            <li><a href="{{ route('dashboard') }}">Perfis</a></li>
        </ul>
    @endif

    <p class="menu-label mt-4">
        Sessão
    </p>
    <ul class="menu-list">
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="button is-text is-small pl-0">Sair</button>
            </form>
        </li>
    </ul>
</aside>