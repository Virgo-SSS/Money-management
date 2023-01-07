<nav class="navbar navbar-expand-md navbar-light bg-nav nav-shadow rounded" style="margin: 10px">
    <div class="container">
        <button id="hamburger" class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="padding:0" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ Avatar::create(Auth::user()->name)->toBase64(); }}" />
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a href="{{ route('settings') }}" class="dropdown-item">
                        Settings
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

