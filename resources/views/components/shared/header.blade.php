<header class="uc-header">
    <div class="uc-header__container container">
        <div class="uc-header__logo">
            <a href="{{ route('dashboard') }}">
                <strong>Localizador de contato</strong>
            </a>
        </div>

        <nav class="uc-header__nav">
            <ul class="uc-header__menu">
                <li><a href="{{ route('contacts.index') }}">Contatos</a></li>
                <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
            </ul>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>